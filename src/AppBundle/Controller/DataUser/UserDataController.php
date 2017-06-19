<?php

namespace AppBundle\Controller\DataUser;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\EditCustomerDataForm;
use AppBundle\Entity\User;

class UserDataController extends Controller
{
    /**
     * @Route("/zmienDane/{id}/edit", name="changeData")
     */
	 public function changeUserDataAction(Request $request, $id){
	 	
	 	$em = $this->getDoctrine()->getManager();
	 	$userData = $em->getRepository('AppBundle:User')->find($id);
	 	
	 	
	 	$form = $this->createForm(EditCustomerDataForm::class, $userData);
	 	
	 	$form->handleRequest($request);
	 	
	 	if($form->isValid() && $form->isSubmitted()){
	 		
	 		$em->persist($userData);
	 		$em->flush();
	 	}
	 	
	 	
		 return $this->render('dataCustomer/changeDataCustomer.html.twig', [
		 		'editUserForm' => $form->createView(),
		 ]);

	 }
	 

	 
}