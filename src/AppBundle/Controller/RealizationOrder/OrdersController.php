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
	 * @Route("/metody_platnosci", name="realizationByPayPallOrder")
	 */
	public function OrderAction($amount){
		
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
	
	
	
	
}