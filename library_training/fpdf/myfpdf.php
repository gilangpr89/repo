<?php
require_once('fpdf.php');

class myfpdf extends FPDF
{

	// Margins
	var $left = 10;
	var $right = 10;
	var $top = 10;
	var $bottom = 10;
	var $fillColor = '255,255,255';
	var $fontName	= 'Arial';
	var $align		= '';
	var $font_style	= '';
	var $font_style1	= 'B';
	var $textcolor	= '0,0,0';
	var $font_size	= 8 ;
	var $linewidth	= 0.2;
	var $drawcolor	= '0,0,0';
	var $linearea	= 'LTBR';
	var $height		= 5 ;
	var $angle = 0;

	function Header()
	{
		
		/*
		 * images config
		*/
		$positionX 		=	15;
		$positionY		=	5;
		$scaleX			=	53;
		$scaleY			=	17;
		
		$this->Image(LOGOREPORT_PATH. '/library_training/fpdf/hivos.png',$positionX,$positionY,$scaleX,$scaleY);
		$this->SetFont('Arial','B',14);
		$this->Cell(80);
		$this->SetTextColor(255,192,203);
		$this->Cell(30,10,'REPORT DATA',0,0,'C');
		$this->Ln(20);
		$this->Line(10,25,200,25);
		//$this->RotatedText(35,190,'Preview Only!',45);
		
	}
	
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

	
	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	
   function WriteTable($tcolums)
   {
   		
      // go through all colums
      for ($i = 0; $i < sizeof($tcolums); $i++)
      {
         $current_col = $tcolums[$i];
         $height = 0;
         
         // get max height of current col
         $nb=0;
         for($b = 0; $b < sizeof($current_col); $b++)
         {
         	$this->fillColor 	= (  array_key_exists( 'fillcolor', $current_col[$b] )   )? $current_col[$b]['fillcolor'] :  $this->fillColor ;
         	$this->fontName 	= (  array_key_exists( 'font_name', $current_col[$b] )   )? $current_col[$b]['font_name'] :  $this->fontName ;
         	$this->font_style 	= (  array_key_exists( 'font_style', $current_col[$b])  )? $current_col[$b]['font_style'] :  $this->font_style ;
         	$this->textcolor 	= (  array_key_exists( 'textcolor', $current_col[$b])  )? $current_col[$b]['textcolor'] :  $this->textcolor ;
         	$this->font_size 	= (  array_key_exists( 'font_size', $current_col[$b])  )? $current_col[$b]['font_size'] :  $this->font_size ;
         	$this->linewidth 	= (  array_key_exists( 'linewidth', $current_col[$b])  )? $current_col[$b]['linewidth'] :  $this->linewidth ;
         	$this->drawcolor 	= (  array_key_exists( 'drawcolor', $current_col[$b])  )? $current_col[$b]['drawcolor'] :  $this->drawcolor ;
         	$this->linearea 	= (  array_key_exists( 'linearea', $current_col[$b])  )? $current_col[$b]['linearea'] :  $this->linearea ;
         	$this->height 		= (  array_key_exists( 'height', $current_col[$b])  )? $current_col[$b]['height'] :  $this->height ;
            // set style
            $this->SetFont( $this->fontName, $this->font_style , $this->font_size );
            $color = explode(",", $this->fillColor);
            $this->SetFillColor($color[0], $color[1], $color[2]);
            
            $color = explode(",", $this->textcolor );
            $this->SetTextColor($color[0], $color[1], $color[2]);  
                      
            $color = explode(",", $this->drawcolor );            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth( $this->linewidth );
                        
            $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));            
            $height = $this->height ;
         }  
         $h=$height*$nb;
         
         
         // Issue a page break first if needed
         $this->CheckPageBreak($h);
         
         // Draw the cells of the row
         for($b = 0; $b < sizeof( $current_col ); $b++)
         {
         	$this->fillColor 	= (  array_key_exists( 'fillcolor', $current_col[$b] )   )? $current_col[$b]['fillcolor'] :  $this->fillColor ;
         	$this->fontName 	= (  array_key_exists( 'font_name', $current_col[$b] )   )? $current_col[$b]['font_name'] :  $this->fontName ;
         	$this->align 		= (  array_key_exists( 'align', $current_col[$b] 	 )   )? $current_col[$b]['align'] 	  :  $this->align ;
         	$this->font_style 	= (  array_key_exists( 'font_style', $current_col[$b])   )? $current_col[$b]['font_style']:  $this->font_style ;
         	$this->textcolor 	= (  array_key_exists( 'textcolor', $current_col[$b])  )? $current_col[$b]['textcolor'] :  $this->textcolor ;
         	$this->font_size 	= (  array_key_exists( 'font_size', $current_col[$b])  )? $current_col[$b]['font_size'] :  $this->font_size ;
         	$this->linewidth 	= (  array_key_exists( 'linewidth', $current_col[$b])  )? $current_col[$b]['linewidth'] :  $this->linewidth ;
         	$this->drawcolor 	= (  array_key_exists( 'drawcolor', $current_col[$b])  )? $current_col[$b]['drawcolor'] :  $this->drawcolor ;
         	$this->linearea 	= (  array_key_exists( 'linearea', $current_col[$b])  )? $current_col[$b]['linearea'] :  $this->linearea ;
         	$this->height 		= (  array_key_exists( 'height', $current_col[$b])  )? $current_col[$b]['height'] :  $this->height ;
         	
            $w = $current_col[$b]['width'];
            $a = $this->align;
            
            // Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            
            // set style
            $this->SetFont( $this->fontName , $this->font_style , $this->font_size	 );
            $color = explode(",", $this->fillColor );
            $this->SetFillColor($color[0], $color[1], $color[2]);
            
            $color = explode(",", $this->textcolor );
            $this->SetTextColor($color[0], $color[1], $color[2]); 
                       
            $color = explode(",", $this->drawcolor );            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth( $this->linewidth );
            
            $color = explode(",", $this->fillColor );            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            
            
            // Draw Cell Background
            $this->Rect($x, $y, $w, $h, 'FD');
            
            $color = explode(",", $this->drawcolor );   
                     
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            
            // Draw Cell Border
            if (substr_count( $this->linearea , "T") > 0)
            {
               $this->Line($x, $y, $x+$w, $y);
            }            
            
            if (substr_count( $this->linearea , "B") > 0)
            {
               $this->Line($x, $y+$h, $x+$w, $y+$h);
            }            
            
            if (substr_count( $this->linearea , "L") > 0)
            {
               $this->Line($x, $y, $x, $y+$h);
            }
                        
            if (substr_count( $this->linearea , "R") > 0)
            {
               $this->Line($x+$w, $y, $x+$w, $y+$h);
            }
            
            
            // Print the text
            $this->MultiCell($w, $this->height , $current_col[$b]['text'], 0, $a, 0);
            
            // Put the position to the right of the cell
            $this->SetXY($x+$w, $y);         
         }
         
         // Go to the next line
         $this->Ln($h);          
      }                  
   }

   
   // If the height h would cause an overflow, add a new page immediately
   function CheckPageBreak($h)
   {
      if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }


   // Computes the number of lines a MultiCell of width w will take
   function NbLines($w, $txt)
   {
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r", '', $txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
         $c=$s[$i];
         if($c=="\n")
         {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
         }
         if($c==' ')
            $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
            if($sep==-1)
            {
               if($i==$j)
                  $i++;
            }
            else
               $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
         }
         else
            $i++;
      }
      return $nl;
   }
	function Footer()
	{
	$this->SetY(-15);
	$this->Line(10,$this->GetY(),200,$this->GetY());
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
}