<?php

namespace AppBundle\Controller\RealizationOrder;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Buying;
use AppBundle\Form\UserDataFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/zamowienie")
 */
class OrdersController extends Controller
{
	/**
	 * @Route("/realizuj", name="realizationOrder")
	 */
	public function acceptDataAction(Request $request){
		

		$session = $request->getSession();
		$session->start();
		$form = $this->createForm(UserDataFormType::class);
	
		$form->handleRequest($request);
		if($form->isValid() && $form->isSubmitted()){
			
			foreach ($session->get('aBasket') as $itemInBasket){
				$dataFromForm = $form->getData();
				$buying = new Buying();
				$buying->setProduct($itemInBasket['name']);
				$buying->setPrice($itemInBasket['price'] * $itemInBasket['amount']);
				$buying->setAmount($itemInBasket['amount']);
				$buying->setUserName($dataFromForm['name']);
				$buying->setCity($dataFromForm['city']);
				$buying->setStreet($dataFromForm['street']);
				$em = $this->getDoctrine()->getManager();
				$em->persist($buying);
				$em->flush();
			}
			//$session->remove('aBasket');
			return $this->redirectToRoute('homepage');

		}
		
		return $this->render('realizationOrder/acceptData.html.twig', array(
				'form' => $form->createView()
		));
	}
	
	/**
	 * @Route("/historiaZakupow", name="history")
	 */
	public function showHistoryAction(Request $request){
		
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
		}
			
	}
	
	
	
	
	
}