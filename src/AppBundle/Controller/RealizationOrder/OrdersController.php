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
use AppBundle\Entity\Buying;

/**
 * @Route("/zamowienie")
 */
class OrdersController extends Controller
{
	/**
	 * @Route("/realizuj", name="realizationOrder")
	 */
	public function acceptDataAction(){
		
		$dataCurrentUser = $this->getUser();
		return $this->render('realizationOrder/acceptData.html.twig',[
			'dataCurrentUser' => $dataCurrentUser,
		]);
	}
	
	/**
	 * @Route("/historiaZakupow", name="history")
	 */
	public function showHistoryAction(){
		
		$securityContext = $this->container->get('security.authorization_checker');
		
		if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
			$em = $this->getDoctrine()->getManager();
			$basketCurrentUser= $em->getRepository('AppBundle:Basket')->findByUser($this->getUser());
			foreach($basketCurrentUser as $item){
				
				$buying = new Buying();
				$buying->setProduct($item->getItem()->getName());
				$buying->setPrice($item->getItem()->getPrice()*$item->getAmount());
				$buying->setAmount($item->getAmount());
				$buying->setUsername($this->getUser()->getName());
				$buying->setCity($this->getUser()->getCity());
				$buying->setStreet($this->getUser()->getStreet());
				$buying->setUser($this->getDoctrine()->getRepository('AppBundle:User')->find($this->getUser()));
				
				$em->persist($buying);
				$em->remove($item);
				$em->flush();
			}
			
			$buyingByCurrentUser= $em->getRepository('AppBundle:Buying')->findByUser($this->getUser());
			return $this->render('realizationOrder/history.html.twig', [
					'buyingByCurrentUser' => $buyingByCurrentUser
			]);
		}else{
			
		}
	}
	
	
	
	
	
}