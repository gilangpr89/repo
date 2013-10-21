<?php
require_once''.APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once''.APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';
class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_modelDetail;
	protected $_modelTrtraining;
	protected $_modelTrainingView;
	protected $_msCountry;
	protected $_modelParticipants;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        
		$this->_model = new participants_Model_Participants();
		$this->_modelTrtraining = new trtrainings_Model_TrTrainings();
		$this->_msCountry = new countries_Model_Country();
 		$this->_modelTrainingView = new trtrainings_Model_TrTrainingsView();
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_modelTrainingView = new trtrainings_Model_TrTrainingsView();
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
//				print_r($id);
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
// 		try {
// 			if(isset($this->_posts['START_DATE']) && $this->_posts['END_DATE'] && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
// 				$q = $this->_modelTrainingView->select()
// 				->setIntegrityCheck(false)
// 				->from('TR_TRAININGS_VIEW', array('TRAINING_ID'))
// 				->where('SDATE >= ?', $this->_posts['START_DATE'])
// 				->where('SDATE <= ?', $this->_posts['END_DATE']);
// 				$list = $q->query()->fetchAll();
				
// 				$ids = array();
// 				foreach($list as $k=>$v) {
// 					$ids[] = $v['TRAINING_ID'];
// 				}
				
// 				$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('TRAINING_ID IN (?)', $ids);
// 			}
// 			$this->_data['items'] = $this->_modelTrainingView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
// 			$this->_data['totalCount'] = $this->_modelTrainingView->count($this->_where);
// 		} catch(Exception $e) {
// 			$this->exception($e);
// 		}
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

// 		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
// 			$id = $this->_enc->base64decrypt($this->_posts['ID']);
// 		    $q = $this->_modelParticipants->select()->from('MS_PARTICIPANTS',array('*'))->where('ID = ?', $id);
// 		    $listParticipant = $q->query()->fetchAll();
			
			$q = $this->_modelDetail->select()->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'));
			$query = $q->query()->fetchAll();

			$filename ='ReportParticipant.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');

			$pdf->Cell(10,10,'Report Participant',0,1,'');
			
			/* Start Dynamic Label Table */
			$pdf->Ln('10');
			$negara = $this->_msCountry->select()->from('MS_COUNTRY', array('NAME'));
			$daftar = $negara->query()->fetchAll();
			foreach ($daftar as $kunci=>$nilai) {
				$var[] = $nilai['NAME'];
			}

			/*Start Header Table */
			$push = $var;
			array_unshift($push, 'Training Name');
			
			$HeaderTable = array_unique($push);
			$headerTable = array($HeaderTable);
			
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$array = array_values($split);
			$col = array();
			for ($i = 0; $i < count($array); ++$i) {
			$col[] = array('text' => $array[$i] , 'width' => '45','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			}
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
			
			/* End Header Table */
			
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_modelTrainingView->select()->from('TR_TRAININGS_VIEW', array('TRAINING_NAME','VENUE_COUNTRY_NAME'));
			$query = $x->query()->fetchAll();
				
			$c = array();
			foreach ($query as $key=>$value) {
				if(!isset($c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']])) {
					$c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']] = 1;
				} else {
					$c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']]++;
				}
			}
			
// 			print_r($c);

			$columns = array();
			$temp='';
			foreach ($c as $key=>$value) {
			
				$col = array();
				$col[] = array('text' => ''.$key ,'width' => '45','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				foreach ($value as $k=>$v) {
						$temp = $temp.$v;
				}
				$col[] = array('text' => $temp ,'width' => '45','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$columns[] = $col;
				$temp = '';

			}
			$pdf->WriteTable($columns);
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
	}
}