<?php

class Reports_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelTrtrainingView;
	protected $_modelTraining;
	protected $_modelView;
	protected $_modelParticipants;
	protected $_modelParticipantsView;
	protected $_modelOrganizationsView;
	protected $_modelCountryView;
	protected $_modelRegionView;

	public function init()
	{
		$this->_model = new trtrainings_Model_TrTrainingsView();
		$this->_modelTraining = new trainingparticipants_Model_TrainingParticipants();
		$this->_modelView = new trainingparticipants_Model_TrainingParticipantsView();
		
		$this->_modelParticipants = new participants_Model_Participants();
		$this->_modelParticipantsView = new participants_Model_ParticipantsView();
		$this->_modelOrganizationsView = new organizations_Model_OrganizationsView();
		$this->_modelCountryView = new countries_Model_Country();
		$this->_modelRegionView = new arealevels_Model_AreaLevelsView();
		
	}
	
	public function trainingAction() {
		try {
			if(isset($this->_posts['TRAINING_NAME'])) {
				$name = $this->_posts['TRAINING_NAME'];
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('TRAINING_NAME LIKE ?', '%' . $name . '%');
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch (Exception $e) {
			$this->exception($e);
		}
	}
    public function trtEvaluationAction() {
    	try {
    		$list = array();
    		if(isset($this->_posts['PARTICIPANT_ID'])) {
    			$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANT_ID']);
    			if($this->_modelView->isExist('PARTICIPANT_ID', $id)) {
    				$q = $this->_modelView->select()->where('PARTICIPANT_ID = ?', $id);
    				$listTemp = $q->query()->fetchAll();
    				if(count($listTemp) > 0) {
    					$trainingIds = array();
    					foreach($listTemp as $k => $v) {
    						if(!in_array($v['TRAINING_ID'], $trainingIds)) {
    							$trainingIds[] = $v['TRAINING_ID'];
    						}
    					}
    					/* Filter  Date Query */
    					if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE'])) {
    						$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
    						$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
    					}
    					$this->_where[] = $this->_model->getAdapter()->quoteInto('TRAINING_ID IN (?)', $trainingIds);
    					$list = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
    					$this->_totalCount = $this->_model->count($this->_where);
    	
    				}
    			} else {
    				$this->error(101, 'Invalid training.');
    			}
    		} else {
    			$this->error(101, 'Invalid training.');
    		}
    		$this->_data['items'] = $list;
    		$this->_data['totalCount'] = $this->_totalCount;
    	} catch(Exception $e) {
    		$this->exception($e);
    	}
    }
	/* Get List Organization */
    public function cboAction()
	{   
		try {
			if(isset($this->_posts['NAME'])) {
			$name = $this->_posts['NAME'];
			$this->_where[] = $this->_modelOrganizationsView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
			}
			$this->_data['items'] = $this->_modelOrganizationsView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelOrganizationsView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	/* Get List Organization Training */
	public function cboTrainingsAction()
	{
		try {
			$list = array();
			if(isset($this->_posts['ORGANIZATION_ID']) && !empty($this->_posts['ORGANIZATION_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
				if($this->_model->isExist('ORGANIZATION_ID', $id)) {
					if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
						$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
						$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
					}
					$q = $this->_model->select()->where('ORGANIZATION_ID = ?', $id);
					$list = $q->query()->fetchAll();
					if(count($list) > 0) {
						$trainingIds = array();
						foreach($list as $k => $v) {
							if(!in_array($v['ID'], $trainingIds)) {
								$trainingIds[] = $v['ID'];
							}
						}
					}
						$this->_where[] = $this->_model->getAdapter()->quoteInto('ID IN (?)', $trainingIds);
	
						$list = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_totalCount = $this->_model->count($this->_where);
				} else {
					$this->error(101, 'Invalid Cbo.');
				}
			} else {
				$this->error(101, 'Invalid Cbo.');
			}
			$this->_data['items'] = $list;
			$this->_data['totalCount'] = $this->_totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	/* Get List Participant */
	public function individualAction()
	{		
	     try {
	     	if(isset($this->_posts['NAME'])) {
	     		$name = $this->_posts['NAME'];
	     		$this->_where[] = $this->_modelParticipantsView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
	     	}
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
						
						if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE'])) {
							$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
							$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
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
	
	public function srcountryAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
				$name = $this->_posts['NAME'];
				$this->_where[] = $this->_modelCountryView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
			}
			$this->_data['items'] = $this->_modelCountryView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelCountryView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	/* Get List Organization Training */
	public function srcountryTrainingsAction()
	{
		try {
			$list = array();
			
			if(isset($this->_posts['ORGANIZATION_COUNTRY_ID']) && !empty($this->_posts['ORGANIZATION_COUNTRY_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_COUNTRY_ID']);
				if($this->_model->isExist('ORGANIZATION_COUNTRY_ID', $id)) {
						if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE'])) {
							$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
							$this->_where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
						}
						$this->_where[] = $this->_model->getAdapter()->quoteInto('ORGANIZATION_COUNTRY_ID = ?', $id);
						$list = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_totalCount = $this->_model->count($this->_where);
				} else {
					$this->error(101, 'Invalid Country.');
				}
			} else {
				$this->error(101, 'Invalid Country.');
			}
			$this->_data['items'] = $list;
			$this->_data['totalCount'] = $this->_totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function regionAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
				$name = $this->_posts['NAME'];
				$this->_where[] = $this->_modelRegionView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
			}
			$this->_data['items'] = $this->_modelRegionView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelRegionView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function regionTrainingsAction()
	{
		try {
			$list = array();
			/* Beda Table View rubah code buat print*/
			if(isset($this->_posts['REGION_ID']) && !empty($this->_posts['REGION_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['REGION_ID']);
				if($this->_modelRegionView->isExist('ID', $id)) {
					
					$where = array();
					/* Check for period */

					if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE'])) {
						$where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
						$where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
					}
					$where[] = $this->_model->getAdapter()->quoteInto('AREA_LEVEL_ID = ?',$id);
					$q = $this->_model->select();
					foreach($where as $k=>$v) {
						$q->where($v);
					}
					$list = $q->query()->fetchAll();
					if(count($list) > 0) {
						$trainingIds = array();
						foreach($list as $k => $v) {
							if(!in_array($v['ID'], $trainingIds)) {
								$trainingIds[] = $v['ID'];
							}
						}
						$this->_where[] = $this->_model->getAdapter()->quoteInto('ID IN (?)', $trainingIds);
	
						$list = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_totalCount = $this->_model->count($this->_where);
					}
				} else {
					$this->error(101, 'Invalid Region.');
				}
			} else {
				$this->error(101, 'Invalid Region.');
			}
			$this->_data['items'] = $list;
			$this->_data['totalCount'] = $this->_totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}