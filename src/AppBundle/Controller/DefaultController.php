<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\SearchUserForm;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$posts = $this->getDoctrine()->getManager()->createQueryBuilder()
       	       ->select('u')
        	   ->from('AppBundle:Item', 'u')
        	   ->getQuery()
        	   ->getResult();

       	
        return $this->render('default/index.html.twig',[
			'posts' => $posts,
		]);
    }
    

    
	 /**
     * @Route("/profile", name="userprofile")
     */
    public function searchAction(Request $request)
    {
		$form = $this->createForm(SearchUserForm::class);
		$form->handleRequest($request);
		if($form->isValid() && $form->isSubmitted()){
			
			$username = $form->getData();
			
			if(isset($username)){
				$searchUser = $this->getDoctrine()->getManager()->createQueryBuilder()
					->select('p')
					->from('AppBundle:User', 'p')
					->where('p.username LIKE :username')
					->setParameter('username', '%'.$username['_username'].'%')
					->getQuery()
					->getResult();	
			}
			
		}
    	
		return $this->render('profile/userProfile.html.twig', [
			'form' => $form->createView(),
			'searchUser' => isset($searchUser) ? $searchUser : ' ',
		]);
    }
}
