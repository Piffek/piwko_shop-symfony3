<?php 
namespace AppBundle\Controller\Basket;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\RedirectResponse;


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
		
		}
			return $this->render('basket/index.html.twig');
	}
	
	/**
	 * @Route("/deleteWithBasket/{id}", name="deleteWithBasket")
	 */
	public function deleteWitBasketAction(Request $request, $id){
		$securityContext = $this->container->get('security.authorization_checker');
		
		if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
			
			$em = $this->getDoctrine()->getManager();
			$itemInBasket= $em->getRepository('AppBundle:Basket')->find($id);
			
			if (!$itemInBasket) {
				throw $this->createNotFoundException(
						'No basket found for id '.$id
						);
			}
			$em->remove($itemInBasket);
			$em->flush();
			
		}else{
			$session = $request->getSession();
			$session->start();
			foreach($session->get('aBasket') as $unset){
			 $session->remove($unset['id']);
			}
		}
		return $this->redirect('/koszyk');
		//return $this->render('basket/index.html.twig');
	}

}