<?php

class Reports_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_model;
	protected $_modelTraining;
	protected $_modelView;

	public function init()
	{
		$this->_model = new reports_Model_Report();
		$this->_modelTraining = new trainingparticipants_Model_TrainingParticipants();
		$this->_modelView = new trainingparticipants_Model_TrainingParticipantsView();
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
	
	public function individualAction()
	{
	     try {
	     	
// 			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
// 				$Id = (int)$this->_enc->base64decrypt($this->_posts['ID']);
// 				if($this->_modelDetail->isExist('TRAINING_ID', $Id)) {
// 					$this->_where[] = $this->_modelTraining->getAdapter()->quoteInto('TRAINING_ID = ?', $Id);
// 				} 
// 			}
			
// 			$list = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order);
			
// 			$this->_data['items'] = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order, $this->_where);
// 			$this->_data['totalCount'] = $this->_modelTraining->count($this->_where);
			
	     	
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