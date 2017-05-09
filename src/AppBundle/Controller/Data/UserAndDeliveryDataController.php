<?php

namespace AppBundle\Controller\Data;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserDataFormType;

class UserAndDeliveryDataController extends Controller
{
    /**
     * @Route("/zmienDane", name="changeData")
     */
	 public function changeUserDataAction(){
		 
		 $form = $this->createForm(UserDataFormType::class);
		 
		 $form->handlerRequest($request);
		 
		 if($form->isValid() && $form->idSubmitted()){
			 
		 }
	 }
	 
	 /**
     * @Route("/dodajDaneDostawy", name="addDataDelivery")
     */
	 public function addDeliveryDataAction(){
		 
	 }
	 
}