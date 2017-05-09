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
	 public function changeUserDataAction(Request $request, User $user){
	 	

	 	
	 	$form = $this->createForm(EditCustomerDataForm::class, $user);
	 	
	 	$form->handleRequest($request);
	 	
	 	if($form->isValid() && $form->isSubmitted()){
	 		$user = $form->getData();
	 		$em = $this->getDoctrine()->getManager();
	 		$em->persist($user);
	 		$em->flush();
	 		
	 		return $this->redirectToRoute('admin_genus_list');
	 	}
	 	
	 	
		 return $this->render('dataCustomer/changeDataCustomer.html.twig', [
		 		'editUserForm' => $form->createView(),
		 ]);

	 }
	 

	 
}