<?php

namespace AppBundle\Controller\RealizationOrder;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Order;
use JMS\Payment\CoreBundle\Form\ChoosePaymentMethodType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\PluginController\Result;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/orders")
 */
class OrdersController extends Controller
{
	/**
	 * @Route("/new/{amount}", name="realizationOrder")
	 */
	public function newAction($amount){
		
		$em = $this->getDoctrine()->getManager();
		
		$order = new Order($amount);
		$em->persist($order);
		$em->flush();
	
		return $this->redirect($this->generateUrl('app_orders_show', [
				'id' => $order->getId(),
		]));
	}
	
	/**
	 * @Route("/{id}/show", name="app_orders_show")
	 * @Template
	 */
	public function showAction(Request $request, Order $order)
	{
		$config = [
				'paypal_express_checkout' => [
						'return_url' => 'http://localhost:8000',
						'cancel_url' => 'https://example.com/cancel-url',
						'useraction' => 'commit',
				],

		];
		
		$form = $this->createForm(ChoosePaymentMethodType::class, null, [
				'amount'          => 1.00,
				'currency'        => 'EUR',
				'predefined_data' => $config,
		]);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$ppc = $this->get('payment.plugin_controller');
			$ppc->createPaymentInstruction($instruction = $form->getData());
		
			$order->setPaymentInstruction($instruction);
		
			$em = $this->getDoctrine()->getManager();
			$em->persist($order);
			$em->flush($order);
		
			return $this->redirect($this->generateUrl('app_orders_paymentcreate', [
					'id' => $order->getId(),
			]));
		}
	
		return $this->render('realizationOrder/index.html.twig', [
				'order' => $order,
				'form'  => $form->createView(),
		]);

	}
	
	private function createPayment($order)
	{
		$instruction = $order->getPaymentInstruction();
		$pendingTransaction = $instruction->getPendingTransaction();
	
		if ($pendingTransaction !== null) {
			return $pendingTransaction->getPayment();
		}
	
		$ppc = $this->get('payment.plugin_controller');
		$amount = $instruction->getAmount() - $instruction->getDepositedAmount();
	
		return $ppc->createPayment($instruction->getId(), $amount);
	}
	
	/**
	 * @Route("/{id}/payment/create", name="app_orders_paymentcreate")
	 */
	public function paymentCreateAction(Order $order)
	{
		$payment = $this->createPayment($order);
	
		$ppc = $this->get('payment.plugin_controller');
		$result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());
	
		if ($result->getStatus() === Result::STATUS_SUCCESS) {
			return $this->redirect($this->generateUrl('app_orders_paymentcomplete', [
					'id' => $order->getId(),
			]));
		}
	
		if ($result->getStatus() === Result::STATUS_PENDING) {
			$ex = $result->getPluginException();
		
			if ($ex instanceof ActionRequiredException) {
				$action = $ex->getAction();
		
				if ($action instanceof VisitUrl) {
					return $this->redirect($action->getUrl());
				}
			}
		}
		
		throw $result->getPluginException();
	
	}
	
	
	/**
	 * @Route("/{id}/payment/complete", name="app_orders_paymentcomplete")
	 */
	public function paymentCompleteAction(Order $order)
	{
		return new Response('Payment complete');
	}
}