<?php

class Report_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_model;
	protected $_modelTraining;
	protected $_modelView;

	public function init()
	{
		$this->_model = new report_Model_Report();
		$this->_modelTraining = new trainingparticipants_Model_TrainingParticipants();
		$this->_modelView = new trainingparticipants_Model_TrainingParticipantsView();
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
					
				$countryId = (isset($this->_posts['COUNTRY_ID'])) ? $this->_enc->base64decrypt($this->_posts['COUNTRY_ID']) : '';
				
				if($this->_modelCountry->isExists(array($this->_modelCountry->getAdapter()->quoteInto('ID = ?', $countryId)))) {

					if(!$this->_model->isExists(array(
						$this->_model->getAdapter()->quoteInto('COUNTRY_ID = ?', $countryId),
						$this->_model->getAdapter()->quoteInto('NAME = ?', $this->_posts['NAME'])
						))) {

							$this->_model->insert(array(
								'COUNTRY_ID' => $countryId,
								'NAME' => $this->_posts['NAME'],
								'CREATED_DATE' => $this->_date
								));

					} else {
						$this->error(101, $this->_unique . ' already registered, please input another name.');
					}
					
				} else {
					$this->error(102, 'Invalid country.' . $countryId);
				}

			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
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
}