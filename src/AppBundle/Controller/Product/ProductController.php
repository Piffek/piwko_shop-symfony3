<?php 
namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\ProductToBasketFormType;

class ProductController extends Controller
{
	/**
	 * @Route("/produkt/{id}", name="oneProduct")
	 */
	public function oneProductAction(Request $request, $id){
		
		$em = $this->getDoctrine()->getRepository('AppBundle:Item');
		$oneItem = $em->findById($id);
		
		$form = $this->createFormBuilder()
		->add('amount')
		->getForm();
		
		$form->handleRequest($request);
		
		if($form->isValid() && $form->isSubmitted()){
			$itemToBasket = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->
			$em->persist($user);
			$em->flush();
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