<?php

class Reports_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_model;
	protected $_modelTraining;
	protected $_modelView;
	protected $_modelParticipants;
	protected $_modelParticipantsView;

	public function init()
	{
		$this->_model = new trtrainings_Model_TrTrainingsView();
		$this->_modelTraining = new trainingparticipants_Model_TrainingParticipants();
		$this->_modelView = new trainingparticipants_Model_TrainingParticipantsView();
		
		$this->_modelParticipants = new participants_Model_Participants();
		$this->_modelParticipantsView = new participants_Model_ParticipantsView();
	}

    public function cboAction()
	{
	     try {
	     	
			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
				$Id = (int)$this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_modelDetail->isExist('TRAINING_ID', $Id)) {
					$this->_where[] = $this->_modelTraining->getAdapter()->quoteInto('TRAINING_ID = ?', $Id);
				} 
			}
			
			$list = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order);
			
			$this->_data['items'] = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelTraining->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	/* Get List Participant */
	public function individualAction()
	{
	     try {
			$this->_data['items'] = $this->_modelParticipantsView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelParticipantsView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	/* Get List Paricipant Training */
	public function individualTrainingsAction()
	{
		try {
			$list = array();
			if(isset($this->_posts['PARTICIPANT_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANT_ID']);
				if($this->_modelTraining->isExist('PARTICIPANT_ID', $id)) {
					
					$q = $this->_modelTraining->select()->where('PARTICIPANT_ID = ?', $id);
					$list = $q->query()->fetchAll();
					
					if(count($list) > 0) {
						$trainingIds = array();
						foreach($list as $k => $v) {
							if(!in_array($v['TRAINING_ID'], $trainingIds)) {
								$trainingIds[] = $v['TRAINING_ID'];
							}
						}
						
						$this->_where[] = $this->_model->getAdapter()->quoteInto('TRAINING_ID IN (?)', $trainingIds);
						
						$list = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
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

	public function searchAction()
	{
        $start_date = $this->_posts['SDATE'];
 		$end_date = $this->_posts['EDATE'];
 		
 		try {
 		   $id = $this->_model->getTrainingid($start_date, $end_date);
 		   $this->_where[] = $this->_modelView->getAdapter()->quoteInto('TRAINING_ID IN(?)', $id);
 		
 		$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
 		$this->_data['totalCount'] = $this->_modelView->count($this->_where);
 		} catch (Exception $e) {
 			$this->exception($e);
 		}
	}
}