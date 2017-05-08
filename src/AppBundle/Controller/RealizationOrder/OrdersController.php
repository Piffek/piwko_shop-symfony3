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
		
		$em = $this->getDoctrine()->getManager();
		$basketCurrentUser= $em->getRepository('AppBundle:Basket')->findByUser($this->getUser());
		foreach($basketCurrentUser as $item){
			
			$buying = new Buying();
			$buying->setProduct($item->getItem()->getName());
			$buying->setPrice($item->getItem()->getPrice());
			$buying->setAmount($item->getItem()->getAmount());
			
			$em->persist($buying);
			$em->flush();
		}
		
		return $this->render('realizationOrder/history.html.twig', [
			'basketCurrentUser' => $basketCurrentUser
		]);
	}
	
	
	
	
	
}