<?php

namespace AppBundle\Controller\Auth;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\RegisterForm;


class RegisterController extends Controller
{
	/**
	 * @Route("/register/", name="user_registration")
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
    		$user->setActivationKey($this->get('app.hash_activate_key')->hash());
    		$this->sendActivationMail($user);
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
    
    protected function sendActivationMail($user){
    	$message = (new \Swift_Message('hello'))
    	->SetFrom('cos@example.com')
    	->setTo($user->getEmail())
    	->setBody('Hello My Name Is COs http://localhost:8000/activation/'.$user->getActivationKey());
    	$this->get('mailer')->send($message);
    }
    
    

}