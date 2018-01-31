<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {

	public function index()
    {
    
	    //Load the library
	    $this->load->library('html2pdf');
	    
	    //Set folder to save PDF to
	    $this->html2pdf->folder('./assets/pdfs/');
	    
	    //Set the filename to save/download as
	    $this->html2pdf->filename('test.pdf');
	    
	    //Set the paper defaults
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    if($this->html2pdf->create('save')) {
	    	//PDF was successfully saved or downloaded
	    	echo 'PDF saved';
	    }
	    
    } 
    
	public function mail_pdf()
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('email_test.pdf');
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('save')) {
	    	
			$this->load->library('email');

			$this->email->from('your@example.com', 'Your Name');
			$this->email->to('someone@example.com'); 
			
			$this->email->subject('Email PDF Test');
			$this->email->message('Testing the email a freshly created PDF');	

			$this->email->attach($path);

			$this->email->send();
			
			echo $this->email->print_debugger();
						
	    }
	    
    } 

    public function watermark($file=false)
    {
    	# code...
    $this->load->library('Pdf_Rotate');
    $file = base_url()."/hello_world.pdf";// path: file name
    $pdf = new PDF();

    if (file_exists($file)){
        $pagecount = $pdf->setSourceFile($file);
    } else {
        return FALSE;
    }

   $pdf->setWaterText("w a t e r M a r k d e m o ", "s e c o n d L i n e o f t e x t");

  /* loop for multipage pdf */
   for($i=1; $i <= $pagecount; $i++) { 
     $tpl = $pdf->importPage($i);               
     $pdf->addPage(); 
     $pdf->useTemplate($tpl, 1, 1, 0, 0, TRUE);  
   }
    $pdf->Output(); //specify path filename to save or keep as it is to view in browser

 /* rotation.php */
    }
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */