<?php
namespace AppBundle;

class GeneratePDF
{
	public function returnPDFResponseFromHTML($html, $write, $whatDoing){
	
		$pdf = $write->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetAuthor('Our Code World');
		$pdf->SetTitle(('Our Code World Title'));
		$pdf->SetSubject('Our Code World Subject');
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('helvetica', '', 11, '', true);
		$pdf->AddPage();
	
		$filename = 'ourcodeworld_pdf_demo';
	
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		$pdf->Output($filename.".pdf",$whatDoing); // This will output the PDF as a response directly
	}
}