<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fpdf_test extends CI_Controller {

	/**
	 * Example: FPDF 
	 *
	 * Documentation: 
	 * http://www.fpdf.org/ > Manual
	 *
	 */
	public function index() {	
		$this->load->library('fpdf_gen');
		
		$this->fpdf->SetFont('Arial','B',16);
		$this->fpdf->Cell(40,10,'Hello World!');
		
		echo $this->fpdf->Output('hello_world.pdf','D');
	}

	 public function watermark($file=false)
    {
    	# code...
	$this->load->library('fpdf_gen');
    $this->load->library('Pdf_Rotate');
    $this->load->library('wmark');
    $file = base_url()."/hello_world.pdf";// path: file name
   	$img_so = base_url()."/me.jpg";
     $watermark = new Wmark($img_so );
    $watermark->setFontSize(48)
       ->setRotation(30)
       ->setOpacity(.4);
    
    // Watermark with Text
    $watermark->withText('coloftech.com', base_url());
   //$pdf->setWaterText("w a t e r M a r k d e m o ", "s e c o n d L i n e o f t e x t");

  /* loop for multipage pdf 
   for($i=1; $i <= $pagecount; $i++) { 
     $tpl = $pdf->importPage($i);               
     $pdf->addPage(); 
     $pdf->useTemplate($tpl, 1, 1, 0, 0, TRUE);  
   }
    $pdf->Output(); //specify path filename to save or keep as it is to view in browser
    */
 /* rotation.php */
    }
}
