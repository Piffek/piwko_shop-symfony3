<?php

namespace AppBundle\Controller\DataDelivery;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserDataFormType;
use AppBundle\Entity\OtherDeliveryData;

class DeliveryDataController extends Controller
{

	/**
     * @Route("/dodajDaneDostawy", name="addDataDelivery")
     */
	 public function addDeliveryDataAction(Request $request){
		 $form = $this->createForm(UserDataFormType::class);

		 $form->handleRequest($request);
		 $userData = $form->getData();
		 $em = $this->getDoctrine()->getManager();
		 if($form->isValid() && $form->isSubmitted()){
			 
			 $otherDeliveryData = new OtherDeliveryData;
			 $otherDeliveryData->setStreet($userData['street']);
			 $otherDeliveryData->setCity($userData['city']);
			 $otherDeliveryData->setName($userData['name']);
			 $otherDeliveryData->setUser($this->getDoctrine()->getRepository('AppBundle:User')->find($this->getUser()->getId()));
			 $em->persist($otherDeliveryData);
			 $em->flush();
			 return $this->redirectToRoute('addDataDelivery');
		 }
		 $dataDeliveryCurrentUser= $em->getRepository('AppBundle:otherDeliveryData')->findByUser($this->getUser());
		 return $this->render('otherDeliveryCustomer\addOtherDataDelivery.html.twig', [
			'form'=>$form->createView(),
			'dataDeliveryCurrentUser' => $dataDeliveryCurrentUser,
		 ]);
	 }
	 
	 /**
     * @Route("/usunDaneDostawy/{id}", name="deleteDataDelivery")
     */
	 public function deleteDataDeliveryAction($id){
		$em = $this->getDoctrine()->getManager();
		$otherDataCurrentUser= $em->getRepository('AppBundle:OtherDeliveryData')->find($id);

		$em->remove($otherDataCurrentUser);
		$em->flush();
		return $this->redirectToRoute('addDataDelivery');

	 }
}