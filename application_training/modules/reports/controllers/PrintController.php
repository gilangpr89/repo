<?php
require_once APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Reports_PrintController extends MyIndo_Controller_Action
{
	protected $_modelDetail;
	protected $_model;
	protected $_modelParticipants;

	public function init()
	{
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_modelParticipants = new participants_Model_Participants();
		$this->_model = new trtrainings_Model_TrTrainingsView();
	}
	
	public function individualAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;

		
		$pdf->SetFont('Times','',14);
		$pdf->AliasNbPages();

		$filename ='ReportParticipan.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelDetail->select()
			          ->setIntegrityCheck(false)
			          ->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
			          ->where('PARTICIPANT_ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			
			
		    foreach ($list as $val){
		    	$trainingId = $val['TRAINING_ID'];
		    	$x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('BENEFICIARIES_NAME'))->where('TRAINING_ID IN (?)', $id);
		    	$query = $x->query()->fetchAll();
		    	
		    	foreach ($query as $v) {	
		    		$pdf->AddPage('p', 'a4');
			        foreach ($list as $row) {		
				$columns = array();
				$col = array();
				$col[] = array('text' => 'Training Name :'.$row['TRAINING_NAME'], 
						'width' => '95', 
						'height' => '5',
						'align' => 'L',
						'linearea' => '',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
		
				$columns = array();
				$col = array();
				$col[] = array('text' => 'Participant Name'.$row['PARTICIPANT_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',
				);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			
				$columns = array();
				$col = array();
				$col[] = array('text' => 'First Name : '.$row['PARTICIPANT_FNAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',
				);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Middle Name : '.$row['PARTICIPANT_MNAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Last Name : '.$row['PARTICIPANT_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Surname : '.$row['PARTICIPANT_SNAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Gender : '.$row['PARTICIPANT_GENDER'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Brith Date : '.$row['PARTICIPANT_BDATE'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Mobile Number : '.$row['PARTICIPANT_MOBILE_NO'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Phone Number : '.$row['PARTCIPANT_PHONE_NO'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				
				$columns = array();
				$col = array();
				$col[] = array('text' =>'Beneficiarie Name :' . $v['BENEFICIARIES_NAME'] .'',
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea' => '',
				);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'First Email : '.$row['PARTICIPANT_EMAIL1'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Second Email : '.$row['PARTICIPANT_EMAIL2'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
					
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Facebook : '.$row['PARTICIPANT_FB'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Twitter : '.$row['PARTICIPANT_TWITTER'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'DETAIL TRAINING PARTICIPANTS' , 
						'width' => '175',
						'height'=>'6',
						'align' => 'C',
						'linearea'=>'LTBR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization City : '.$row['ORGANIZATION_CITY_NAME'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LTR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Province : '.$row['ORGANIZATION_PROVINCE_NAME'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Country : '.$row['ORGANIZATION_COUNTRY_NAME'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Name : '.$row['ORGANIZATION_NAME'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Phone : '.$row['ORGANIZATION_PHONE_NO1'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Second Phone : '.$row['ORGANIZATION_PHONE_NO2'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Email : '.$row['ORGANIZATION_EMAIL1'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Second Email : '.$row['ORGANIZATION_EMAIL2'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Website : '.$row['ORGANIZATION_WEBSITE'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Address : '.$row['ORGANIZATION_ADDRESS'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Position Name : '.$row['POSITION_NAME'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Pre Test : '.$row['PRE_TEST'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Post Test : '.$row['POST_TEST'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Diff : '.$row['DIFF'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'LR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Created Date : '.$row['CREATED_DATE'] ,
						'width' => '175',
						'height'=>'6',
						'align' => 'L',
						'linearea'=>'BRL',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				
				 
			}
			}
		    }
			//$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
				
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	public function cboAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
	
	
		$pdf->SetFont('Times','',14);
		$pdf->AliasNbPages();
	
		$filename ='ReportCbo.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelDetail->select()
			->setIntegrityCheck(false)
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
			->where('ORGANIZATION_ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
				
				
			foreach ($list as $val){
				$trainingId = $val['TRAINING_ID'];
				$x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('BENEFICIARIES_NAME'))->where('TRAINING_ID IN (?)', $id);
				$query = $x->query()->fetchAll();
			  
				foreach ($query as $v) {
					$pdf->AddPage('p', 'a4');
					foreach ($list as $row) {
						$columns = array();
						$col = array();
						$col[] = array('text' => 'Training Name :'.$row['TRAINING_NAME'],
								'width' => '95',
								'height' => '5',
								'align' => 'L',
								'linearea' => '',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array('text' => 'Participant Name'.$row['PARTICIPANT_NAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array('text' => 'First Name : '.$row['PARTICIPANT_FNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Middle Name : '.$row['PARTICIPANT_MNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Last Name : '.$row['PARTICIPANT_NAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Surname : '.$row['PARTICIPANT_SNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Gender : '.$row['PARTICIPANT_GENDER'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Brith Date : '.$row['PARTICIPANT_BDATE'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Mobile Number : '.$row['PARTICIPANT_MOBILE_NO'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Phone Number : '.$row['PARTCIPANT_PHONE_NO'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array('text' =>'Beneficiarie Name :' . $v['BENEFICIARIES_NAME'] .'',
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea' => '',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'First Email : '.$row['PARTICIPANT_EMAIL1'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Second Email : '.$row['PARTICIPANT_EMAIL2'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Facebook : '.$row['PARTICIPANT_FB'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Twitter : '.$row['PARTICIPANT_TWITTER'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'DETAIL TRAINING PARTICIPANTS' ,
								'width' => '175',
								'height'=>'6',
								'align' => 'C',
								'linearea'=>'LTBR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization City : '.$row['ORGANIZATION_CITY_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LTR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Province : '.$row['ORGANIZATION_PROVINCE_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Country : '.$row['ORGANIZATION_COUNTRY_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Name : '.$row['ORGANIZATION_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Phone : '.$row['ORGANIZATION_PHONE_NO1'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Second Phone : '.$row['ORGANIZATION_PHONE_NO2'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Email : '.$row['ORGANIZATION_EMAIL1'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Second Email : '.$row['ORGANIZATION_EMAIL2'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Website : '.$row['ORGANIZATION_WEBSITE'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Address : '.$row['ORGANIZATION_ADDRESS'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Position Name : '.$row['POSITION_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Pre Test : '.$row['PRE_TEST'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Post Test : '.$row['POST_TEST'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Diff : '.$row['DIFF'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Created Date : '.$row['CREATED_DATE'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'BRL',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
							
					}
				}
			}
			//$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
	
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	public function srcountryAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
	
	
		$pdf->SetFont('Times','',14);
		$pdf->AliasNbPages();
	
		$filename ='ReportSrCountry.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelDetail->select()
			->setIntegrityCheck(false)
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
			->where('ORGANIZATION_COUNTRY_ID = ?', $id);
			echo $q;die('aaa');
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
	        
	
			foreach ($list as $val){
				$trainingId = $val['TRAINING_ID'];
				$x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('BENEFICIARIES_NAME'))->where('TRAINING_ID IN (?)', $id);
				$query = $x->query()->fetchAll();
					
				foreach ($query as $v) {
					$pdf->AddPage('p', 'a4');
					foreach ($list as $row) {
						$columns = array();
						$col = array();
						$col[] = array('text' => 'Training Name :'.$row['TRAINING_NAME'],
								'width' => '95',
								'height' => '5',
								'align' => 'L',
								'linearea' => '',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array('text' => 'Participant Name'.$row['PARTICIPANT_NAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array('text' => 'First Name : '.$row['PARTICIPANT_FNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Middle Name : '.$row['PARTICIPANT_MNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Last Name : '.$row['PARTICIPANT_NAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Surname : '.$row['PARTICIPANT_SNAME'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Gender : '.$row['PARTICIPANT_GENDER'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Brith Date : '.$row['PARTICIPANT_BDATE'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Mobile Number : '.$row['PARTICIPANT_MOBILE_NO'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Phone Number : '.$row['PARTCIPANT_PHONE_NO'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array('text' =>'Beneficiarie Name :' . $v['BENEFICIARIES_NAME'] .'',
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea' => '',
						);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'First Email : '.$row['PARTICIPANT_EMAIL1'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Second Email : '.$row['PARTICIPANT_EMAIL2'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Facebook : '.$row['PARTICIPANT_FB'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Twitter : '.$row['PARTICIPANT_TWITTER'] ,
								'width' => '95',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'DETAIL TRAINING PARTICIPANTS' ,
								'width' => '175',
								'height'=>'6',
								'align' => 'C',
								'linearea'=>'LTBR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization City : '.$row['ORGANIZATION_CITY_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LTR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Province : '.$row['ORGANIZATION_PROVINCE_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Country : '.$row['ORGANIZATION_COUNTRY_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Name : '.$row['ORGANIZATION_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Phone : '.$row['ORGANIZATION_PHONE_NO1'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Second Phone : '.$row['ORGANIZATION_PHONE_NO2'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Email : '.$row['ORGANIZATION_EMAIL1'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Second Email : '.$row['ORGANIZATION_EMAIL2'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Website : '.$row['ORGANIZATION_WEBSITE'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Organization Address : '.$row['ORGANIZATION_ADDRESS'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Position Name : '.$row['POSITION_NAME'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Pre Test : '.$row['PRE_TEST'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Post Test : '.$row['POST_TEST'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Diff : '.$row['DIFF'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'LR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
							
						$columns = array();
						$col = array();
						$col[] = array ('text' => 'Created Date : '.$row['CREATED_DATE'] ,
								'width' => '175',
								'height'=>'6',
								'align' => 'L',
								'linearea'=>'BRL',);
						$columns[] = $col;
						$pdf->WriteTable($columns);
	
							
					}
				}
			}
			//$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
	
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	public function regionAction()
	{
		$pdf = new myfpdf('L','mm','A4');
		$h = 13;
		$left = 40;
		$top = 60;
	
	
		$pdf->SetFont('Times','',14);
		//$pdf->AliasNbPages();
		$pdf->AddPage('p', 'a4');
		$pdf->Ln(2);
//  	$pdf->Cell(33,'5','Training Name',1,0,'LTBR',0);

	
		$filename ='ReportRegion.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_model->select()
			->setIntegrityCheck(false)
			->from('TR_TRAININGS_VIEW', array('TRAINING_ID'))
			->where('AREA_LEVEL_ID  IN (?)', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
	        
	        $x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('*'))->where('TRAINING_ID IN (?)', $list);
	        $query = $x->query()->fetchAll();
	        
	        
			foreach ($query as $row){

						$columns = array();
						$col = array();
						$col[] = array('text' => ''. $row['TRAINING_NAME'] . '',
								'width' => '33',
								'height' => '5',
								'align' => 'L',
								'linearea' => 'LTBR',);
						
						$col[] = array('text' => ''.$row['AREA_LEVEL_NAME'],
								'width' => '20',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',
						);

						$col[] = array('text' => ''.$row['FUNDING_SOURCE_NAME'] ,
								'width' => '35',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',
						);
						
						$col[] = array ('text' => ''.$row['ORGANIZATION_NAME'] ,
								'width' => '35',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',);
						
						$col[] = array ('text' => ''.$row['ORGANIZATION_COUNTRY_NAME'] ,
								'width' => '20',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',);

						$col[] = array ('text' => ''.$row['SDATE'] ,
								'width' => '22',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',);

						$col[] = array ('text' => ''.$row['EDATE'] ,
								'width' => '22',
								'height'=>'5',
								'align' => 'L',
								'linearea'=>'LTBR',);
						$columns[] = $col;
 					    $pdf->WriteTable($columns);
					}
			//$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
	
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	
}