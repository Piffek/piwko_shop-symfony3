<?php 
namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Rental;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Basket;
use AppBundle\Entity\Item;


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
	
	
	/**
	 * @Route("/wypozycz/{id}", name="rentProduct")
	 */
	public function rentProductAction($id){
	
		$userId = $this->getUser()->getId();
		$item = $this->getDoctrine()->getRepository('AppBundle:Item')->find($id);
		$user = $this->getDoctrine()->getRepository('AppBundle:User')->find($userId);
		$format = 'Y-m-d H:i:s';
		$todayDate = new \DateTime("now");
		//return new Response($todayDate->date($format));
	
		$regivingDate = new \DateTime("now");
		$regDate = $regivingDate->add(new \DateInterval('P7D'));
	
	
		$rental = new Rental();
		$rental->setItem($item);
		$rental->setUser($user);
		$rental->setForWhen($regDate);
		$em = $this->getDoctrine()->getManager();
		$em->persist($rental);
		$em->flush();
	
		return $this->redirectToRoute('homepage');
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