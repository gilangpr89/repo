<?php
require_once''.APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once''.APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';
class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_modelDetail;
	protected $_modelTrtraining;
	protected $_modelParticipants;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        
		$this->_model = new participants_Model_Participants();
		$this->_modelTrtraining = new trtrainings_Model_TrTrainings();
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_modelParticipants = new participants_Model_Participants();
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
			//$list = array();
			if(isset($this->_posts['PARTICIPANTS_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANTS_ID']);
				//print_r($id);
				if($this->_modelDetail->isExist('PARTICIPANT_ID', $id)) {
					$q = $this->_modelDetail->select()->where('PARTICIPANT_ID = ?', $id);
					$listtmp = $q->query()->fetchAll();
					if(count($listtmp) > 0) {
						$trainingIds = array();
						foreach($listtmp as $k => $v) {
							if(!in_array($v['TRAINING_ID'], $trainingIds)) {
								$trainingIds[] = $v['TRAINING_ID'];
							}
						}
					}
						
						$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('PARTICIPANT_ID = ?', $id);
						$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('TRAINING_ID IN (?)', $trainingIds);
				}
						$this->_data['items'] = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_data['totalCount'] = $this->_modelDetail->count($this->_where);		
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function detailAction()
	{
		try {
			if(isset($this->_posts['START_DATE']) && $this->_posts['END_DATE']) {

				$q = $this->_modelTrtrainingView->select()
				->setIntegrityCheck(false)
				->from('TR_TRAININGS_VIEW', array('TRAINING_ID'))
				->where('SDATE >= ?', $this->_posts['START_DATE'])
				->where('SDATE <= ?', $this->_posts['END_DATE']);
				$list = $q->query()->fetchAll();
				
				$ids = array();
				foreach($list as $k=>$v) {
					$ids[] = $v['TRAINING_ID'];
				}
				
				$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('TRAINING_ID IN (?)', $ids);
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
		
		$pdf->SetFont('Arial','',12);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		if(isset($this->_posts['PARTICIPANT_ID']) && !empty($this->_posts['PARTICIPANT_ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANT_ID']);
		    $q = $this->_modelParticipants->select()->from('MS_PARTICIPANTS',array('*'))->where('ID = ?', $id);
		    $listParticipant = $q->query()->fetchAll();
			
			$q = $this->_modelDetail->select()
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
 			//->join('TR_TRAINING_PARTICIPANTS_VIEW', 'TR_TRAINING_PARTICIPANTS_VIEW.TRAINING_ID = TR_TRAININGS_VIEW.TRAINING_ID', array('*'))
			->where('PARTICIPANT_ID = ?', $id);
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();

			$filename ='ReportParticipant.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
			
			foreach ($listParticipant as $val) {;
				$columns = array();
				$col = array();
				$col[] = array('text' => 'First Name : '.$val['FNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Middle Name : '.$val['MNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Last Name : '.$val['LNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Surname : '.$val['SNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Gender : '.$val['GENDER'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Brith Date : '.$val['BDATE'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Mobile Number : '.$val['MOBILE_NO'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Phone Number : '.$val['PHONE_NO'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'First Email : '.$val['EMAIL1'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Second Email : '.$val['EMAIL2'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
					
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Facebook : '.$val['FB'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Twitter : '.$val['TWITTER'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			}
			/* Start Label Table */
			$pdf->Ln('10');
			$headerTable = array(
					array(
							'col1'	=> 'Training Name',
// 							'col2'	=> 'Organization City',
// 							'col3'	=> 'Organization Province',
// 							'col4'  => 'Organization Country',
							'col5'  => 'Organization',
							'col6'  => 'Position',
							'col7'  => 'Pre Test',
							'col8'  => 'Post Test',
							'col9'  => 'Diff',
					),
			);
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col2'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col3'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col4'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
 			$col[] = array('text' => $split['col5'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col6'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col7'] , 'width' => '15','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col8'] , 'width' => '15','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col9'] , 'width' => '10','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);
			
			foreach ($list as $row) {
				
		    $columns = array();
	        $col = array();
		    $col[] = array('text' => '' .$row['TRAINING_NAME'],'width' => '35','height'=>'5', 'align' => 'L','linearea' => 'LTBR',);
// 	        $col[] = array('text' => '' .$row['ORGANIZATION_CITY_NAME'] ,'width' => '25','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => '' .$row['ORGANIZATION_PROVINCE_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => '' .$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['ORGANIZATION_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_PHONE_NO1'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_PHONE_NO2'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_EMAIL1'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_EMAIL2'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_WEBSITE'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_ADDRESS'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'',);
	        $col[] = array('text' => '' .$row['POSITION_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['PRE_TEST'] ,'width' => '15','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['POST_TEST'] ,'width' => '15','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['DIFF'] ,'width' => '10','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        //$col[] = array('text' => 'Created Date : '.$row['CREATED_DATE'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
			}
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
}