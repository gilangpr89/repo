<?php
require_once('myfpdf.php');



class templatepdf extends MYFPDF
{
    
    var $encrypted = false;  //whether document is protected
	var $Uvalue;             //U entry in pdf document
	var $Ovalue;             //O entry in pdf document
	var $Pvalue;             //P entry in pdf document
	var $enc_obj_id;   
	
	var $angle=0;    // for function watermark
	
	//var $borderActive ;
	//var $userLocation ;
	//var $lnHeader ;
	
	function Header()
	{
	
	    
	$this->SetFont('Arial','B',25);
	$this->SetTextColor(255,192,203);
	$this->RotatedText(80,220,'BERLAKU SEBAGAI FAKTUR PAJAK',45);
	$this->RotatedText(100,225,'SETELAH LUNAS',45);
	
	/*
	 * images config
	 */
	$positionX 		=	15;
	$positionY		=	5;
	$scaleX			=	53;
	$scaleY			=	17;
	
	$this->SetFont('Arial','',12);
	
	$this->Image(LOGOINVOICE_PATH.'/docs/invoicelogo/logo-jict.gif',$positionX,$positionY,$scaleX,$scaleY);

	$this->Cell(145);
	$this->SetFont('Arial','',11);
	$this->SetTextColor(0,0,0);
	$this->Cell(0,7,'   NOMOR : '.INVOICENUMBER.'',1,2,'L');
	$this->ln(8);
		$this->SetFont('Arial','',9);

		$columns = array();  
		$col = array();
    		$col[] = array('text' =>'ALAMAT ' , 'width' => '36','height'=>'5', 'align' => 'L','linearea'=>'');
    		$col[] = array('text' => ':' , 'width' => '3','height'=>'5', 'align' => 'L','linearea'=>'');
    		$col[] = array('text' => 'Jl.Sulawesi Ujung No.1 Tanjung Priok,Jakarta 14310' , 'width' => '100','height'=>'5', 'align' => 'L','linearea'=>'');
    	$columns[] = $col;
	$this->WriteTable($columns);
    
		$columns = array();  
		$col = array();
    		$col[] = array('text' =>'N.P.W.P ' , 'width' => '36','height'=>'5', 'align' => 'L','linearea'=>'' );
    		$col[] = array('text' => ':' , 'width' => '3','height'=>'5', 'align' => 'L','linearea'=>'');
    		$col[] = array('text' => '01.886.839.8-092.000' , 'width' => '50','height'=>'5', 'align' => 'L','linearea'=>'');
    	$columns[] = $col;
	$this->WriteTable($columns);
    
		$columns = array();  
		$col = array();
    		$col[] = array('text' =>'Tanggal Pengukuhan PKP ' , 'width' => '36','height'=>'5', 'align' => 'L','linearea'=>'');
    		$col[] = array('text' => ':' , 'width' => '3','height'=>'5', 'align' => 'L','linearea'=>'');
    		$col[] = array('text' => '1 Juli 2002' , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'');
    	$columns[] = $col;
	$this->WriteTable($columns);
    $this->setY(21);
    $this->setX(117);
    
	$this->Cell(70,5,'Kode & Seri Faktur pajak : ',$borderActive ,2);
	$this->Cell(70,5,'Nota dan Perhitungan Pelayanan jasa ini berlaku sebagai Faktur Pajak',$borderActive ,2);
	$this->Cell(70,5,'berdasarkan : Keputusan Direktur Jenderal Pajak No. PER-10/PJ./2010',$borderActive ,2);
	$this->Cell(70,5,'tanggal 09 Maret 2010',$borderActive ,2);
    // buat garis
    $this->ln(1);
			$columns = array();  
		$col = array();
    		$col[] = array('text' =>'______________________________________________________________________________________________________________________________' , 'width' => '200','height'=>'5', 'align' => 'L','linearea'=>'', 'textcolor' => '0,0,0');
    	$columns[] = $col;
	$this->WriteTable($columns);
	
	
	}


	//Page footer
	function Footer(){
	 //$this->Cell(50);
	    
	    $this->SetY(-50);
	// Go to 1.5 cm from bottom
    
    // Select Arial italic 8
    
    $this->SetTextColor(1,1,1);
    $this->SetFont('Arial','',8);
    

		$this->SetX(5);
    $this->Cell(70,5,'_________________________________________________________________________________________________________________________________',$borderActive ,2);
	$this->Cell(70,5,'KETENTUAN : ',$borderActive ,2);
	$this->Cell(70,5,'1.Dalam waktu 8 hari kerja setelah nota ini diterima,tidak ada pengajuan keberaran',$borderActive ,2);
	$this->Cell(70,5,'   saudara dianggap setuju',$borderActive ,2);
	$this->Cell(70,5,'2.Terhadap Nota yang diajukan koreksi harus dilunasi terlebih dahulu.',$borderActive ,2);
	$this->Cell(70,5,'3.Pembayaran harus dilunasi dalam 8 hari kerja setelah nota ini diterima jika, ',$borderActive ,2);
	$this->Cell(70,5,'   tidak, dikenakan denda 2% perbulan atas sangsi lainnya ',$borderActive ,2);
	$this->Cell(70,5,'4.Tidak dibenarkan memberi imbalan kepada petugas. ',$borderActive ,2);

	$this->SetY(237);
	$this->SetX(138);
	$this->Cell(111,50,'JAKARTA , '.DATEINVOICE.' ',$borderActive ,2);

	$this->SetY(241);
	$this->SetX(138);
	$this->Cell(120,50,'JAKARTA INTERNATIONAL CONTAINER TERMINAL. ',$borderActive ,2);

	$this->SetY(250);
	$this->SetX(180);
	$this->Cell(135,50,NAME,$borderActive ,2);
	
	$this->SetY(250);
	$this->SetX(175);
	$this->Cell(130,50,'____________________  ',$borderActive ,2);
	
	
	$this->SetY(253);
	$this->SetX(180);
	$this->Cell(135,50,'ID : '.ID.'',$borderActive ,2);
	
	
		
	// for logo footer
	$positionX 		=	125;
	$positionY		=	270;
	$scaleX			=	53;
	$scaleY			=	17;
	
	$this->SetFont('Arial','',12);
	
	$this->Image(LOGOINVOICE_PATH.'/docs/invoicelogo/logo-jict.gif',$positionX,$positionY,$scaleX,$scaleY);
	
	//$this->SetX(1);
	
	
	}
	
	/* start of fungsi for watermark
	 * 
	 */
	
	
// test function water mark


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

function RotatedText($x, $y, $txt, $angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->Text($x,$y,$txt);
	$this->Rotate(0);
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


/*
 * end of function watermark
 */
	
	// fungsi for password pdf
	
	/*
	
if(function_exists('mcrypt_encrypt'))
{
	function RC4($key, $data)
	{
		return mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $data, MCRYPT_MODE_STREAM, '');
	}
}
else
{
	function RC4($key, $data)
	{
		static $last_key, $last_state;

		if($key != $last_key)
		{
			$k = str_repeat($key, 256/strlen($key)+1);
			$state = range(0, 255);
			$j = 0;
			for ($i=0; $i<256; $i++){
				$t = $state[$i];
				$j = ($j + $t + ord($k[$i])) % 256;
				$state[$i] = $state[$j];
				$state[$j] = $t;
			}
			$last_key = $key;
			$last_state = $state;
		}
		else
			$state = $last_state;

		$len = strlen($data);
		$a = 0;
		$b = 0;
		$out = '';
		for ($i=0; $i<$len; $i++){
			$a = ($a+1) % 256;
			$t = $state[$a];
			$b = ($b+$t) % 256;
			$state[$a] = $state[$b];
			$state[$b] = $t;
			$k = $state[($state[$a]+$state[$b]) % 256];
			$out .= chr(ord($data[$i]) ^ $k);
		}
		return $out;
	}
}
	*/

function SetProtection($permissions=array(), $user_pass='', $owner_pass=null)
	{
		$options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32 );
		$protection = 192;
		foreach($permissions as $permission)
		{
			if (!isset($options[$permission]))
				$this->Error('Incorrect permission: '.$permission);
			$protection += $options[$permission];
		}
		if ($owner_pass === null)
			$owner_pass = uniqid(rand());
		$this->encrypted = true;
		$this->padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08".
						"\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
		$this->_generateencryptionkey($user_pass, $owner_pass, $protection);
	}

/****************************************************************************
*                                                                           *
*                              Private methods                              *
*                                                                           *
****************************************************************************/

	function _putstream($s)
	{
		if ($this->encrypted) {
			$s = RC4($this->_objectkey($this->n), $s);
		}
		parent::_putstream($s);
	}

	function _textstring($s)
	{
		if ($this->encrypted) {
			$s = RC4($this->_objectkey($this->n), $s);
		}
		return parent::_textstring($s);
	}

	/**
	* Compute key depending on object number where the encrypted data is stored
	*/
	function _objectkey($n)
	{
		return substr($this->_md5_16($this->encryption_key.pack('VXxx',$n)),0,10);
	}

	function _putresources()
	{
		parent::_putresources();
		if ($this->encrypted) {
			$this->_newobj();
			$this->enc_obj_id = $this->n;
			$this->_out('<<');
			$this->_putencryption();
			$this->_out('>>');
			$this->_out('endobj');
		}
	}

	function _putencryption()
	{
		$this->_out('/Filter /Standard');
		$this->_out('/V 1');
		$this->_out('/R 2');
		$this->_out('/O ('.$this->_escape($this->Ovalue).')');
		$this->_out('/U ('.$this->_escape($this->Uvalue).')');
		$this->_out('/P '.$this->Pvalue);
	}

	function _puttrailer()
	{
		parent::_puttrailer();
		if ($this->encrypted) {
			$this->_out('/Encrypt '.$this->enc_obj_id.' 0 R');
			$this->_out('/ID [()()]');
		}
	}

	/**
	* Get MD5 as binary string
	*/
	function _md5_16($string)
	{
		return pack('H*',md5($string));
	}

	/**
	* Compute O value
	*/
	function _Ovalue($user_pass, $owner_pass)
	{
		$tmp = $this->_md5_16($owner_pass);
		$owner_RC4_key = substr($tmp,0,5);
		return RC4($owner_RC4_key, $user_pass);
	}

	/**
	* Compute U value
	*/
	function _Uvalue()
	{
		return RC4($this->encryption_key, $this->padding);
	}

	/**
	* Compute encryption key
	*/
	function _generateencryptionkey($user_pass, $owner_pass, $protection)
	{
		// Pad passwords
		$user_pass = substr($user_pass.$this->padding,0,32);
		$owner_pass = substr($owner_pass.$this->padding,0,32);
		// Compute O value
		$this->Ovalue = $this->_Ovalue($user_pass,$owner_pass);
		// Compute encyption key
		$tmp = $this->_md5_16($user_pass.$this->Ovalue.chr($protection)."\xFF\xFF\xFF");
		$this->encryption_key = substr($tmp,0,5);
		// Compute U value
		$this->Uvalue = $this->_Uvalue();
		// Compute P value
		$this->Pvalue = -(($protection^255)+1);
	}
}
