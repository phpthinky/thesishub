<?php 

class WPDF extends PDF_Rotate{
        protected $_outerText1;// dynamic text
        protected $_outerText2;

        function setWaterText($txt1="", $txt2=""){
            $this->_outerText1 = $txt1;
            $this->_outerText2 = $txt2;
        }

        function Header(){
            //Put the watermark
            $this->SetFont('Arial','B',40);
            $this->SetTextColor(255,192,203);
                    $this->SetAlpha(0.5);
            $this->RotatedText(35,190, $this->_outerText1, 45);
            $this->RotatedText(75,190, $this->_outerText2, 45);
        }

        function RotatedText($x, $y, $txt, $angle){
            //Text rotated around its origin
            $this->Rotate($angle,$x,$y);
            $this->Text($x,$y,$txt);
            $this->Rotate(0);
        }
    }
/*
    $file = "path/filename.pdf";// path: file name
    $pdf = new PDF();

    if (file_exists($file)){
        $pagecount = $pdf->setSourceFile($file);
    } else {
        return FALSE;
    }

   $pdf->setWaterText("w a t e r M a r k d e m o ", "s e c o n d L i n e o f t e x t");

  /* loop for multipage pdf */
  /*
   for($i=1; $i <= $pagecount; $i++) { 
     $tpl = $pdf->importPage($i);               
     $pdf->addPage(); 
     $pdf->useTemplate($tpl, 1, 1, 0, 0, TRUE);  
   }
    $pdf->Output(); //specify path filename to save or keep as it is to view in browser

 /* rotation.php */
/*    require('fpdf.php');
require('fpdi.php');
class PDF_Rotate extends FPDI
{
    var $angle=0;
    var $extgstates = array();

    function Rotate($angle,$x=-1,$y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }

    function _endpage()
    {
        if($this->angle!=0)
        {
            $this->angle=0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function SetAlpha($alpha, $bm='Normal')
    {
        // set alpha for stroking (CA) and non-stroking (ca) operations
        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
        $n = count($this->extgstates)+1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
            $this->PDFVersion='1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++)
        {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_out('<</Type /ExtGState');
            foreach ($this->extgstates[$i]['parms'] as $k=>$v)
                $this->_out('/'.$k.' '.$v);
            $this->_out('>>');
            $this->_out('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_out('/ExtGState <<');
        foreach($this->extgstates as $k=>$extgstate)
            $this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');
        $this->_out('>>');
    }

    function _putresources()
    {
        $this->_putextgstates();
        parent::_putresources();
    }

}

*/