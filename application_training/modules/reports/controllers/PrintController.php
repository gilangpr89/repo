<?php

require_once APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Reports_PrintController extends MyIndo_Controller_Action
{
	protected $_modelDetail;

	public function init()
	{
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
	}
	
	public function individualAction()
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
		
				
			$q = $this->_modelDetail->select()
			//->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('ID','TRAINING_ID','TRAINING_NAME','PARTICIPANT_ID','PARTICIPANT_NAME','PARTICIPANT_FNAME','PARTICIPANT_MNAME','PARTICIPANT_LNAME',
					'PARTICIPANT_SNAME','PARTICIPANT_GENDER','PARTICIPANT_BDATE','PARTICIPANT_MOBILE_NO','PARTCIPANT_PHONE_NO','PARTICIPANT_EMAIL1','PARTICIPANT_EMAIL2','PARTICIPANT_FB',
					'PARTICIPANT_TWITTER','ORGANIZATION_ID','ORGANIZATION_CITY_ID','ORGANIZATION_CITY_NAME','ORGANIZATION_PROVINCE_ID','ORGANIZATION_PROVINCE_NAME','ORGANIZATION_COUNTRY_ID',
					'ORGANIZATION_COUNTRY_NAME','ORGANIZATION_NAME','ORGANIZATION_PHONE_NO1','ORGANIZATION_PHONE_NO2','ORGANIZATION_EMAIL1','ORGANIZATION_EMAIL2','ORGANIZATION_WEBSITE',
					'ORGANIZATION_ADDRESS','POSITION_ID','POSITION_NAME','PRE_TEST','POST_TEST','DIFF','CREATED_DATE','MODIFIED_DATE'))
					->where('PARTICIPANT_ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
				
			//$list = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			//print_r($list);die();
		
				
			$filename ='ReportParticipant.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
				
			foreach ($list as $row) {
		
				$columns = array();
				$col = array();
				$col[] = array('text' => 'Training :' .$row['TRAINING_NAME'],
						'width' => '95',
						'height'=>'8',
						'align' => 'L',
						'linearea' => '',
				);
		
				$columns[] = $col;
				$pdf->WriteTable($columns);
		
				$columns = array();
				$col = array();
				$col[] = array('text' => 'Name : '.$row['PARTICIPANT_NAME'] ,
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
				$col[] = array ('text' => 'Organization City : '.$row['ORGANIZATION_CITY_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Province : '.$row['ORGANIZATION_PROVINCE_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Country : '.$row['ORGANIZATION_COUNTRY_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Name : '.$row['ORGANIZATION_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Phone : '.$row['ORGANIZATION_PHONE_NO1'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Second Phone : '.$row['ORGANIZATION_PHONE_NO2'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Email : '.$row['ORGANIZATION_EMAIL1'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Second Email : '.$row['ORGANIZATION_EMAIL2'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Website : '.$row['ORGANIZATION_WEBSITE'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Organization Address : '.$row['ORGANIZATION_ADDRESS'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Position Name : '.$row['POSITION_NAME'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Pre Test : '.$row['PRE_TEST'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Post Test : '.$row['POST_TEST'] ,
						'width' => '95',
						'height'=>'5',
						'align' => 'L',
						'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Diff : '.$row['DIFF'] ,
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
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
				
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
}