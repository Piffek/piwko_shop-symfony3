<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\RegisterForm;


class RegisterController extends Controller
{
	/**
	 * @Route("/register", name="user_registration")
	 */
    public function registerAction(Request $request)
    {
    	$form = $this->createForm(RegisterForm::class);
    	
    	$form->handleRequest($request);
    	if($form->isValid() && $form->isSubmitted())
    	{
    		/**
    		 * 
    		 * @var User $user
    		 */
    		$user = $form->getData();
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();
    		return $this->redirectToRoute('homepage');
    	}
    	
    	return $this->render(
    			'auth/registerForm.html.twig',
    			array('form' => $form->createView())
    			);
    
    }
    
    

}