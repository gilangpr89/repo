<?php 
require_once('fpdf.php');

class templatepdf extends FPDF {
	
	var $tablewidths;
	var $headerset;
	var $footerset;
	
function _beginpage($orientation, $format) {
    $this->page++;
    if(!$this->pages[$this->page]) // solves the problem of overwriting a page if it already exists
        $this->pages[$this->page]='';
    $this->state=2;
    $this->x=$this->lMargin;
    $this->y=$this->tMargin;
    $this->FontFamily='';
    //Check page size
    if($orientation=='')
        $orientation=$this->DefOrientation;
    else
        $orientation=strtoupper($orientation[0]);
    if($format=='')
        $format=$this->DefPageFormat;
    else
    {
        if(is_string($format))
            $format=$this->_getpageformat($format);
    }
    if($orientation!=$this->CurOrientation || $format[0]!=$this->CurPageFormat[0] || $format[1]!=$this->CurPageFormat[1])
    {
        //New size
        if($orientation=='P')
        {
            $this->w=$format[0];
            $this->h=$format[1];
        }
        else
        {
            $this->w=$format[1];
            $this->h=$format[0];
        }
        $this->wPt=$this->w*$this->k;
        $this->hPt=$this->h*$this->k;
        $this->PageBreakTrigger=$this->h-$this->bMargin;
        $this->CurOrientation=$orientation;
        $this->CurPageFormat=$format;
    }
    if($orientation!=$this->DefOrientation || $format[0]!=$this->DefPageFormat[0] || $format[1]!=$this->DefPageFormat[1])
        $this->PageSizes[$this->page]=array($this->wPt, $this->hPt);
}

function Header()
{
    global $maxY;

    // Check if header for this page already exists
    if(!$this->headerset[$this->page]) {

        foreach($this->tablewidths as $width) {
            $fullwidth += $width;
        }
        $this->SetY(($this->tMargin) - ($this->FontSizePt/$this->k)*2);
        $this->cellFontSize = $this->FontSizePt ;
        $this->SetFont('Arial','',( ( $this->titleFontSize) ? $this->titleFontSize : $this->FontSizePt ));
        $this->Cell(0,$this->FontSizePt,$this->titleText,0,1,'C');
        $l = ($this->lMargin);
        $this->SetFont('Arial','',$this->cellFontSize);
        foreach($this->colTitles as $col => $txt) {
            $this->SetXY($l,($this->tMargin));
            $this->MultiCell($this->tablewidths[$col], $this->FontSizePt,$txt);
            $l += $this->tablewidths[$col] ;
            $maxY = ($maxY < $this->getY()) ? $this->getY() : $maxY ;
        }
        $this->SetXY($this->lMargin,$this->tMargin);
        $this->setFillColor(200,200,200);
        $l = ($this->lMargin);
        foreach($this->colTitles as $col => $txt) {
            $this->SetXY($l,$this->tMargin);
            $this->cell($this->tablewidths[$col],$maxY-($this->tMargin),'',1,0,'L',1);
            $this->SetXY($l,$this->tMargin);
            $this->MultiCell($this->tablewidths[$col],$this->FontSizePt,$txt,0,'C');
            $l += $this->tablewidths[$col];
        }
        $this->setFillColor(255,255,255);
        // set headerset
        $this->headerset[$this->page] = 1;
    }

    $this->SetY($maxY);
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
	
function Footer() {
    // Check if footer for this page already exists
    if(!$this->footerset[$this->page]) {
        $this->SetY(-15);
        //Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        // set footerset
        $this->footerset[$this->page] = 1;
    }
}

function morepagestable($lineheight=8) {
    // some things to set and 'remember'
    $l = $this->lMargin;
    $startheight = $h = $this->GetY();
    $startpage = $currpage = $this->page;

    // calculate the whole width
    foreach($this->tablewidths as $width) {
        $fullwidth += $width;
    }

    // Now let's start to write the table
    $row = 0;
    while($data=mysql_fetch_row($this->results)) {
        $this->page = $currpage;
        // write the horizontal borders
        $this->Line($l,$h,$fullwidth+$l,$h);
        // write the content and remember the height of the highest col
        foreach($data as $col => $txt) {

            $this->page = $currpage;
            $this->SetXY($l,$h);
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,$this->colAlign[$col]);

            $l += $this->tablewidths[$col];

            if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                $tmpheight[$row.'-'.$this->page] = $this->GetY();
            }
            if($this->page > $maxpage)
                $maxpage = $this->page;
            unset($data[$col]);
        }
        // get the height we were in the last used page
        $h = $tmpheight[$row.'-'.$maxpage];
        // set the "pointer" to the left margin
        $l = $this->lMargin;
        // set the $currpage to the last page
        $currpage = $maxpage;
        unset($data[$row]);
        $row++ ;
    }
    // draw the borders
    // we start adding a horizontal line on the last page
    $this->page = $maxpage;
    $this->Line($l,$h,$fullwidth+$l,$h);
    // now we start at the top of the document and walk down
    for($i = $startpage; $i <= $maxpage; $i++) {
        $this->page = $i;
        $l = $this->lMargin;
        $t = ($i == $startpage) ? $startheight : $this->tMargin;
        $lh = ($i == $maxpage) ? $h : $this->h-$this->bMargin;
        $this->Line($l,$t,$l,$lh);
        foreach($this->tablewidths as $width) {
            $l += $width;
            $this->Line($l,$t,$l,$lh);
        }
    }
    // set it to the last page, if not it'll cause some problems
    $this->page = $maxpage; 
    }
}