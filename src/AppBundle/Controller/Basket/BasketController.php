<?php 
namespace AppBundle\Controller\Basket;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Basket;
use AppBundle\Entity\Item;



class BasketController extends Controller
{
	/**
	 * @Route("/koszyk", name="basket")
	 */
	public function indexAction(){

		$securityContext = $this->container->get('security.authorization_checker');
		if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
			
			$em = $this->getDoctrine()->getRepository('AppBundle:Basket');
			$basketLoggedinUser = $em->findByUser($this->getUser());
			
	

			return $this->render('basket/index.html.twig', [
					'basketLoggedinUser' => $basketLoggedinUser,
			]);
		}else {
			return $this->render('basket/index.html.twig');
		}
		
		
	}
}