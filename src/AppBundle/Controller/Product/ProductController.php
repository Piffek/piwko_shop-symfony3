<?php 
namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

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
			
			foreach($oneItem as $items){
				$amount = $form->getData();
				$session->set('baskets',[
						'name'=>$items->getName(),
						'price'=>$items->getPrice(),
						'amount'=>$amount['amount']
				]);
			}
			
			return $this->redirectToRoute('homepage');
		}

		
		return $this->render('product/oneProduct.html.twig',[
				'oneItem' => $oneItem,
				'form' => $form->createView(),
		]);
	}
	
	public function addProductToBasketAction(){
		
	}
}

?>