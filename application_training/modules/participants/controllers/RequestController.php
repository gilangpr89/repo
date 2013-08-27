<?php
require_once''.APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once''.APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';
class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_modelDetail;
	protected $_modelTrtrainingView;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        
		$this->_model = new participants_Model_Participants();
		$this->_modelTrtrainingView = new trtrainings_Model_TrTrainingsView();
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
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
	

    public function participantTrainingsAction()
	{
		try {
			$list = array();
			if(isset($this->_posts['PARTICIPANTS_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANTS_ID']);
				//print_r($id);
				if($this->_modelDetail->isExist('PARTICIPANT_ID', $id)) {
					$q = $this->_modelDetail->select()->where('PARTICIPANT_ID = ?', $id);
					//echo "$q";
					$list = $q->query()->fetchAll();
					//print_r($list);
					if(count($list) > 0) {
						$trainingIds = array();
						foreach($list as $k => $v) {
							if(!in_array($v['TRAINING_ID'], $trainingIds)) {
								$trainingIds[] = $v['TRAINING_ID'];
							}
						}
						
						$this->_where[] = $this->_modelTrtrainingView->getAdapter()->quoteInto('TRAINING_ID IN (?)', $trainingIds);
						
						$list = $this->_modelTrtrainingView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_totalCount = $this->_model->count($this->_where);
						
					}
				} else {
					$this->error(101, 'Invalid Participant.');
				}
			} else {
				$this->error(101, 'Invalid Participant.');
			}
			$this->_data['items'] = $list;
			$this->_data['totalCount'] = $this->_totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function detailAction()
	{
		try {
// 			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
// 				$Id = (int)$this->_enc->base64decrypt($this->_posts['ID']);
// 				print_r($Id);
			if(isset($this->_posts['TRAINING_NAME'])) {
			$name = $this->_posts['TRAINING_NAME'];
			$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('TRAINING_NAME LIKE ?', '%' . $name . '%');
			//}
			}
			$this->_data['items'] = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelDetail->count($this->_where);
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
		
		if(isset($this->_posts['PARTICIPANT_ID']) && !empty($this->_posts['PARTICIPANT_ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANT_ID']);
		    
			
			
			$q = $this->_modelDetail->select()
			//->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('ID','TRAINING_ID','TRAINING_NAME','PARTICIPANT_ID','PARTICIPANT_NAME','PARTICIPANT_FNAME','PARTICIPANT_MNAME','PARTICIPANT_LNAME',
					'PARTICIPANT_SNAME','PARTICIPANT_GENDER','PARTICIPANT_BDATE','PARTICIPANT_MOBILE_NO','PARTCIPANT_PHONE_NO','PARTICIPANT_EMAIL1','PARTICIPANT_EMAIL2','PARTICIPANT_FB',
					'PARTICIPANT_TWITTER','ORGANIZATION_ID','ORGANIZATION_CITY_ID','ORGANIZATION_CITY_NAME','ORGANIZATION_PROVINCE_ID','ORGANIZATION_PROVINCE_NAME','ORGANIZATION_COUNTRY_ID',
					'ORGANIZATION_COUNTRY_NAME','ORGANIZATION_NAME','ORGANIZATION_PHONE_NO1','ORGANIZATION_PHONE_NO2','ORGANIZATION_EMAIL1','ORGANIZATION_EMAIL2','ORGANIZATION_WEBSITE',
			        'ORGANIZATION_ADDRESS','POSITION_ID','POSITION_NAME','PRE_TEST','POST_TEST','DIFF','CREATED_DATE','MODIFIED_DATE'))
			->join('TR_TRAINING_PARTICIPANTS_VIEW', 'TR_TRAINING_PARTICIPANTS_VIEW.TRAINING_ID = TR_TRAININGS_VIEW.TRAINING_ID', array('BENEFICIARIES_NAME'))
			->where('PARTICIPANT_ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			
			//$list = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			print_r($list);die();

			
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