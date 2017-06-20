<?php 
namespace AppBundle\Controller\Admin\FrontPanel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin")
 */
class IndexController extends Controller
{
	/**
	 * @Route("/", name="adminHomePage")
	 */
	public function indexAction(){

		return $this->render('admin/index.html.twig');
	}
	
	
	
	
	/**
	 * Export to PDF
	 *
	 * @Route("/pdf", name="acme_demo_pdf")
	 */
	public function pdfAction()
	{
		$users = $this->getDoctrine()->getRepository('AppBundle:user')->findAll();
		$html = $this->renderView('Demo/pdf.html.twig', [		
		'users' => $users
				
		]);
	
		$this->get('app.generate_pdf')->returnPDFResponseFromHTML($html, $this->get("white_october.tcpdf"), 'D');
	}
}