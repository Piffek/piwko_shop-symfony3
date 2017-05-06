<?php 
namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Basket;


class ProductController extends Controller
{
	/**
	 * @Route("/produkt/{id}", name="oneProduct")
	 */
	public function oneProductAction(Request $request, $id){
		$session = $request->getSession();
		$session->start();
		$em = $this->getDoctrine()->getRepository('AppBundle:Item');
		$oneItem = $em->findById($id);
		
		$form = $this->createFormBuilder()
		->add('amount')
		->getForm();
		
		$form->handleRequest($request);
		
		if($form->isValid() && $form->isSubmitted()){
			
			$this->checkUserAuth($oneItem, $form, $session, $id);
			return $this->redirectToRoute('homepage');
		}

		return $this->render('product/oneProduct.html.twig',[
				'oneItem' => $oneItem,
				'form' => $form->createView(),
		]);
	}
	
	
	
	public function addProductToBasketIfUserUsLogOffAction($oneItem, $form, $session){
		foreach($oneItem as $items){
			$amount = $form->getData();
			$session->set('basket',[
					'id' => $items->getId(),
					'name'=>$items->getName(),
					'price'=>$items->getPrice(),
					'amount'=>$amount['amount'],
			]);
			$sessionVal = $this->get('session')->get('aBasket');
			$sessionVal[] = $session->get('basket');
			$this->get('session')->set('aBasket', $sessionVal);
		}
	}
	
	
	
	
	public function addProductToBasketIfUserisLogInAction($oneItem, $form, $session, $id){
			
			$amount = $form->getData();
			$basket = new Basket;
			$userid = $this->getUser()->getId();
			$user = $this->getDoctrine()->getRepository('AppBundle:User')->find($userid);
			$item = $this->getDoctrine()->getRepository('AppBundle:Item')->find($id);
			$basket->setUser($user);
			$basket->setItem($item);
			$basket->setAmount($amount['amount']);
			$em = $this->getDoctrine()->getManager();
			$em->persist($basket);
			$em->flush();
	}
	
	
	
	public function checkUserAuth($oneItem, $form, $session, $id){
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$this->addProductToBasketIfUserisLogInAction($oneItem, $form, $session, $id);
		}else{
			$this->addProductToBasketIfUserUsLogOffAction($oneItem, $form, $session);
		}
	}
	
}

?>