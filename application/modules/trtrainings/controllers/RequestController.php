<?php

class Trtrainings_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_unique;
	protected $_required;
	protected $_sData;
	protected $_ids;

	protected $_modelTrainings;
	protected $_modelAreaLevels;
	protected $_modelBeneficiaries;
	protected $_modelFundingSources;
	protected $_modelVenues;
	protected $_modelOrganizations;

	public function init()
	{
		$this->_model = new trtrainings_Model_TrTrainings();
		$this->_modelView = new trtrainings_Model_TrTrainingsView();
		$this->_unique = 'Training';
		$this->_ids = array(
			'TRAINING_ID',
			'AREA_LEVEL_ID',
			'BENEFICIARIES_ID',
			'FUNDING_SOURCE_ID',
			'VENUE_ID',
			'ORGANIZATION_ID'
			);
		$this->_required = $this->_ids;
		$this->_required[] = 'SDATE';
		$this->_required[] = 'EDATE';
		$this->_sData = array();

		$this->_modelAreaLevels = new arealevels_Model_AreaLevels();
		$this->_modelBeneficiaries = new beneficiaries_Model_Beneficiaries();
		$this->_modelFundingSources = new fundingsources_Model_FundingSources();
		$this->_modelOrganizations = new organizations_Model_Organizations();
		$this->_modelTrainings = new trainings_Model_Trainings();
		$this->_modelVenues = new venues_Model_Venues();
	}

	public function createAction()
	{
		try {
			$valid = true;
			foreach($this->_required as $r) {
				if(!isset($this->_posts[$r])) {
					$valid = false;
				} else {
					if(!in_array($r, $this->_ids)) {
						$this->_sData[$r] = $this->_posts[$r];
					} else {
						$this->_sData[$r] = $this->_enc->base64decrypt($this->_posts[$r]);
					}
				}
			}
			if($valid) {
				$error = false;
				$errorMsg = array();

				/* Check for valid Area Levels */
				if(!$this->_modelAreaLevels->isExist('ID', $this->_sData['AREA_LEVEL_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid area level.';
				}

				/* Check for valid Beneficiaries */
				if(!$this->_modelBeneficiaries->isExist('ID', $this->_sData['BENEFICIARIES_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid beneficiaries.';
				}

				/* Check for valid Funding Sources */
				if(!$this->_modelFundingSources->isExist('ID', $this->_sData['FUNDING_SOURCE_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid funding source.';
				}

				/* Check for valid Organizations */
				if(!$this->_modelOrganizations->isExist('ID', $this->_sData['ORGANIZATION_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid organization.';
				}

				/* Check for valid Training */
				if(!$this->_modelTrainings->isExist('ID', $this->_sData['TRAINING_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid training.';
				}

				/* Check for valid Venues */
				if(!$this->_modelVenues->isExist('ID', $this->_sData['VENUE_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid venue.';
				}

				if(!$error) {
					try {
						$this->_sData['CREATED_DATE'] = $this->_date;
						$this->_sData['USER_ID'] = $this->view->USER_ID;
						$this->_model->insert($this->_sData);
					} catch(Exception $e) {
						$this->exception($e);
					}
				} else {
					$msg = '';
					foreach($errorMsg as $k=>$e) {
						if($k>0) {
							$msg .= '<br/>';
						}
						$msg .= $e;
					}
					$this->error(901, $msg);
				}

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
			// if(isset($this->_posts['query'])) {
			// 	$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			// }
			// if(isset($this->_posts['NAME'])) {
			// 	$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			// }
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			if(isset($this->_posts['ID']) && isset($this->_posts['NAME'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				$name = $this->_posts['NAME'];
				$valid = true;
				$q = $this->_model->select()->where('ID = ?', $id);
				if($q->query()->rowCount() > 0) {
					$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
					$details = $q->query()->fetch();
					if($this->_model->isExist('NAME', $name)) {
						if($details['NAME'] != $name) {
							$valid = false;
						}
					}
					if($valid) {
						$this->_model->update(array(
							'NAME' => $name
							), $this->_model->getAdapter()->quoteInto('ID = ?', $id));
					} else {
						$this->error(101, $this->_unique . ' already registered.');
					}
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

	public function destroyAction()
	{
		try {
			if(isset($this->_posts['ID'])) {
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