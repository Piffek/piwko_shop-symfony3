<?php 
namespace AppBundle\Controller\Admin\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Item;
use AppBundle\Form\AddProductForm;


/**
 * @Route("/admin")
 */
class ProductController extends Controller
{
	/**
	 * @Route("/dodajProdukt", name="addProduct")
	 */
	public function addProductAction(Request $request){
		
		$thisItem = new Item;
		$form = $this->createForm(AddProductForm::class, $thisItem);
		$form->handleRequest($request);
		
		if($form->isValid() && $form->isSubmitted()){
			
    		/**
    		 * 
    		 * @var Item $item
    		 */
			$item = $form->getData();
			
			$file = $thisItem->getPhoto();
			$filename = $this->get('app.file_uploader')->upload($file);
			$thisItem->setPhoto($filename);
			$em = $this->getDoctrine()->getManager();
			$em->persist($item);
			
			$file = $item->getPhoto();
			$fileName = $this->get('app.file_uploader')->upload($file);
			$item->setPhoto($fileName);
			
			$em->flush();
			return $this->redirectToRoute('addProduct');
		}
		
		return $this->render('admin/product/addProduct.html.twig', [
		    'form' => $form->createView()]);
	}
}