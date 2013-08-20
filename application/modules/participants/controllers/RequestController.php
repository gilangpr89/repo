<?php
require_once''.APPLICATION_PATH.'/../library/fpdf/fpdf.php';
require_once''.APPLICATION_PATH.'/../library/fpdf/myfpdf.php';
class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$this->_model = new participants_Model_Participants();
		$this->_modelView = new participants_Model_ParticipantsView();
		$this->_unique = 'Participant';
		$this->_required = array(
			'FNAME',
			'MNAME',
			'LNAME',
			'SNAME',
			'GENDER',
			'BDATE',
			'MOBILE_NO',
			'PHONE_NO',
			'EMAIL1',
			'EMAIL2',
			'FB',
			'TWITTER'
			);
		$this->_sData = array();
	}

	public function createAction()
	{
		try {
			$valid = true;
			foreach($this->_required as $r) {
				if(!isset($this->_posts[$r])) {
					$valid = false;
				} else {
					$this->_sData[$r] = $this->_posts[$r];
				}
			}
			if($valid) {
				$this->_sData['CREATED_DATE'] = $this->_date;
				$this->_model->insert($this->_sData);
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function readAction()
	{
		try {
			if(isset($this->_posts['query']) && !empty($this->_posts['query'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['NAME']) && !empty($this->_posts['NAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			if(isset($this->_posts['SNAME']) && !empty($this->_posts['SNAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('SNAME LIKE ?', '%' . $this->_posts['SNAME'] . '%');
			}
			if(isset($this->_posts['MOBILE_NO']) && !empty($this->_posts['MOBILE_NO'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('MOBILE_NO LIKE ?', '%' . $this->_posts['MOBILE_NO'] . '%');
			}
			if(isset($this->_posts['EMAIL1']) && !empty($this->_posts['EMAIL1'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('EMAIL1 LIKE ?', '%' . $this->_posts['EMAIL1'] . '%');
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			$this->_required[] = 'ID';
			$valid = true;
			foreach($this->_required as $r) {
				if(!isset($this->_posts[$r])) {
					$valid = false;
				} else {
					$this->_sData[$r] = $this->_posts[$r];
				}
			}
			if($valid) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_model->isExist('ID', $id)) {
					unset($this->_sData['ID']);
					$this->_model->update($this->_sData, $this->_model->getAdapter()->quoteInto('ID = ?', $id));
				} else {
					$this->error(101);
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function destroyAction()
	{
		try {
			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_model->isExist('ID', $id)) {
					$this->_model->delete($this->_model->getAdapter()->quoteInto('ID = ?', $id));
				} else {
					$this->error(102);
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	

	public function detaiAction()
	{
		try {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_model->select()
			->from('MS_PARTICIPANTS',array('*'))
			->where('ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			print_r($list);
			
			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('ID = ?', $id);
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch (Exception $e) {
			$this->exception($e);
		}
		
			
		
	}
	
	public function detailAction()
	{
		try {
			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
				$Id = (int)$this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_model->isExist('ID', $Id)) {
					$this->_where[] = $this->_modelView->getAdapter()->quoteInto('ID = ?', $Id);
				} else {
					$this->_where[] = $this->_modelView->getAdapter()->quoteInto('ID = ?', 0);
				}
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function printAction()
	{	
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 80;
		
		$pdf->SetFont('Times','',12);
		$pdf->AliasNbPages();
		$pdf->AddPage(); 
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelView->select()
			->from('MS_PARTICIPANTS_VIEW',array('*'))
			->where('ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			
			$filename ='ReportParticipant.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
			
			foreach ($list as $row) {   
	        
	        $columns = array();
	        $col = array();
	        $col[] = array('text' => 'Name : '.$row['NAME'] , 
	        		       'width' => '95',
	        		       'height'=>'5', 
	        		       'align' => 'L',
	        		       'linearea'=>'',
	        		       );
	        
	        
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array('text' => 'First Name : '.$row['FNAME'] , 
	        		       'width' => '95',
	        		       'height'=>'5', 
	        		       'align' => 'L',
	        		       'linearea'=>'',
	        		       );
	        
	        
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Middle Name : '.$row['MNAME'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Last Name : '.$row['LNAME'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Surname : '.$row['SNAME'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Gender : '.$row['GENDER'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Brith Date : '.$row['BDATE'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Mobile Number : '.$row['MOBILE_NO'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Phone Number : '.$row['PHONE_NO'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'First Email : '.$row['EMAIL1'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Second Email : '.$row['EMAIL2'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
			
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Facebook : '.$row['FB'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Twitter : '.$row['TWITTER'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
	        $columns = array();
	        $col = array();
	        $col[] = array ('text' => 'Created Date : '.$row['CREATED_DATE'] ,
	        		'width' => '95',
	        		'height'=>'5',
	        		'align' => 'L',
	        		'linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
			}
			//$pdf->Output('' . $filename . '.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
		
		
// 		header("Pragma: public");
// 		header('Content-Description: File Transfer');
// 		header('Content-Transfer-Encoding: binary');
// 		header("Cache-Control: no-store, no-cache, must-revalidate");
// 		header("Cache-Control: pre-check=0, post-check=0, max-age=0");
// 		header("Pragma: no-cache");
// 		header("Expires: 0");
//         header('Content-Encoding: none');
//         header('Content-Type: application/pdf');  // Change this mime type if the file is not PDF
//         header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');


// 		header('Content-type: application/pdf');
// 		header('Content-Disposition: attachment; filename="' . $filename . '"');
// 		header('Content-Transfer-Encoding: binary');
// 		header('Content-Length: ' . filesize($file));
// 		header('Accept-Ranges: bytes');
		
// 		 $this->getResponse()->setHeader('Content-Type','application/pdf; charset=binary')
// 		  					->setHeader('Content-Disposition', 'attachment; filename="10.pdf"');
//          $filename = $this->sanitizeFilename($this->getRequest()->getParam('filename'));
//          $this->getResponse()->appendBody(file_get_contents($filename)); 
		
// 		header("Pragma: public");
// 		header("Cache-Control: no-store, no-cache, must-revalidate");
// 		header("Cache-Control: pre-check=0, post-check=0, max-age=0");
// 		header("Pragma: no-cache");
// 		header("Expires: 0");
// 		header("Content-Transfer-Encoding: none");
// 		header("Content-Type: application/pdf;");
// 		header("Content-Disposition: attachment; filename=report2_opendebitsummary".date('Ymd').".pdf");
// 		$this->getResponse()
// 					->setHeader('Content-type', 'application/pdf; charset=binary')
// 					->setHeader('Content-Disposition', 'attachment; filename="10.pdf"');
// 		echo $this->getResponse->setContent(file_get_contents(APPLICATION_PATH . '/../public_html' . $id, 'FILE_PATH'));
		
// 		if ($this->_helper->contextSwitch()->getCurrentContext() == 'file') {
// 			$this->getResponse()
// 			->setHeader('Content-type', 'application/pdf; charset=binary')
// 			->setHeader('Content-Disposition', 'attachment; filename="10.pdf"')
// 			->setHeader('Content-length', filesize(APPLICATION_PATH . "/../public_html/pdf/10.pdf"))
// 			->setHeader('Cache-control', 'private');
// 			readfile(APPLICATION_PATH . '/../public_html/pdf/10.pdf');
// 			$this->getResponse()->sendResponse();
		
// 		} else {
// 			throw new Zend_Controller_Action_Exception('File not found', 404);
// 		}

// 		$pdf = new fpdf();
// 		$pdf->SetFont('Arial','B',14);
// 		$pdf->AddPage();
// 		$filename ='ReportParticipant';
		
// 		$pdf->SetFont('Times','B',14);
// 		$pdf->SetXY(10,17);
		
// 		try {
// 			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
// 				$id = $this->_enc->base64decrypt($this->_posts['ID']);
// 				if($this->_model->isExist('ID', $id)) {
// 					$q = $this->_model->select()
// 					->from('MS_PARTICIPANTS',array('*'))
// 					->where('ID = ?', $id);
// 					$q->query()->fetchAll();
// 					$list = $q->query()->fetchAll();
// 					//print_R($list);
					
// 					$columns = array();
// 					$col = array();
// 					foreach ($list as $row) {
											
// 					$col[] = array('text' => $row['FNAME'] , 'width' => '75','height'=>'25', 'align' => 'C','font_size'=>'45','font_style'=>'B','linearea'=>'');
// 					$columns[] = $col;
//                     print_r($columns);
//                     print_r($row['FNAME']);echo "<br />";
//                     $pdf->Cell(30,10,$row['FNAME'],1,'L',0);
//                     $pdf->Output();
								
// 					}

// 				} else {
// 					$this->error(102);
// 				}
// 			} else {
// 				$this->error(901);
// 			}
// 		} catch(Exception $e) {
// 			$this->exception($e);
// 		}
	}
}