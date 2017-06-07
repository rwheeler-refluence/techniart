<?php
require('../fpdf.php');

class PDF extends FPDF
{
//Current column
var $col=0;
//Ordinate of column start
var $y0;

function Header()
{
  $this->SetLeftMargin(10);
}

function Footer()
{

	//Page footer
        
	$this->SetLeftMargin(10);
        $this->SetY(-15);
	$this->SetFont('','I');
	$this->SetTextColor(128);
	$this->SetFillColor(200,220,255);
        $pg1=$this->PageNo();	
        $this->Cell(190,6,"Page " . $pg1,0,0,'L',1);
        $this->Setx(220);
        $pg2=($this->PageNo()+1);
        $this->Cell(190,6,"Page " . $pg2,0,0,'R',1);


$this->Image('logo_pb.png',220,175,190,100); //bottom right
// first num left/right- 2nd is up down 3rd is width 4th is height

        $this->SetFont('Arial','I',8);


}

function SetCol($col)
{
	//Set position at a given column
	$this->col=$col;

        if($this->col==2){
   	  $x=40+$col*90;
	}elseif($this->col==3){
          $x=50+$col*90;
        }else{
          $x=20+$col*90;
        }  

        $this->SetLeftMargin($x);
	$this->SetX($x);
}

function AcceptPageBreak()
{
	//Method accepting or not automatic page break
	if($this->col<3)
	{
		//Go to next column
		$this->SetCol($this->col+1);
		//Set ordinate to top
		$this->SetY($this->y0);
		//Keep on page
		return false;
	}
	else
	{
		//Go back to first column
		$this->SetCol(0);

		//Page break
		return true;

	}
}

function PageTitle($num,$label)
{
	//Title
	$this->SetFont('Arial','',12);
	$this->SetFillColor(200,220,255);
        $oldy=$this->GetY(); 	
        $this->Cell(190,6,"Test $num : $label",0,0,'L',1);
        $this->Setx(220);
        $this->Cell(190,6,"Test $num : $label",0,1,'R',1);
	$this->Ln(4);
	//Save ordinate
	$this->y0=$this->GetY();
}

function PageBody($file)
{
	//Read text file
	$f=fopen($file,'r');
	$txt=fread($f,filesize($file));
	fclose($f);
	
        $txt=substr($txt,0,6100);
	$this->SetFont('Times','',12);
	$this->MultiCell(90,5,$txt);
	$this->Ln();
	
	$this->SetFont('','I');
	
        //Go back to first column
	$this->SetCol(0);
}

function PrintPage($num,$title,$file)
{
	//Add Page
       
   	  $this->AddPage();
	  $this->PageTitle($num,$title);
	  $this->PageBody($file);
        
}

}

$pdf= new PDF('L','mm','A3');
$finish='N';
$title='Test of Multi-column Report';
$pdf->SetTitle($title);
$pdf->SetMargins(10,10,10); 
$pdf->SetAuthor('Fname Lname');
$pdf->PrintPage(1,'Test col','c1.txt');

$pdf->Output();
?>
