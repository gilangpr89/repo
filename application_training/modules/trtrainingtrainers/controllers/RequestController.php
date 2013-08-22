<?php

class Trtrainingtrainers_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_unique;
	protected $_required;
	protected $_sData;
	protected $_ids;

	protected $_modelTraining;
	protected $_modelTrainer;
	protected $_modelRole;
	protected $_modelCity;
	protected $_modelProvince;
	protected $_modelCountry;

	public function init()
	{
		$this->_model = new trtrainingtrainers_Model_TrTrainingTrainers();
		$this->_modelView = new trtrainingtrainers_Model_TrTrainingTrainersView();
		$this->_unique = 'Trainer';
		$this->_ids = array(
			'TRAINING_ID',
			'TRAINER_ID',
			'ROLE_ID',
			'CITY_ID',
			'PROVINCE_ID',
			'COUNTRY_ID'
			);
		$this->_required = $this->_ids;
		$this->_sData = array();

		$this->_modelTraining = new trainings_Model_Trainings();
		$this->_modelTrainer = new trainers_Model_Trainers();
		$this->_modelRole = new roles_Model_Roles();
		$this->_modelCity = new cities_Model_City();
		$this->_modelProvince = new provinces_Model_Provinces();
		$this->_modelCountry = new countries_Model_Country();
		$this->_modelTrTrainings = new trtrainings_Model_TrTrainings();
	}

	public function readAction()
	{
		try {
			if(isset($this->_posts['TRAINING_ID']) && !empty($this->_posts['TRAINING_ID'])) {
				$trainingId = (int)$this->_enc->base64decrypt($this->_posts['TRAINING_ID']);
				if($this->_model->isExist('TRAINING_ID', $trainingId)) {
					$this->_where[] = $this->_modelView->getAdapter()->quoteInto('TRAINING_ID = ?', $trainingId);
				} else {
					$this->_where[] = $this->_modelView->getAdapter()->quoteInto('TRAINING_ID = ?', 0);
				}
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
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

				/* Check for valid Trainings */
				if(!$this->_modelTrTrainings->isExist('ID', $this->_sData['TRAINING_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid training.';
				}

				/* Check for valid Trainer */
				if(!$this->_modelTrainer->isExist('ID', $this->_sData['TRAINER_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid trainer.';
				}

				/* Check for valid Role */
				if(!$this->_modelRole->isExist('ID', $this->_sData['ROLE_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid role.';
				}

				/* Check for valid Country */
				if(!$this->_modelCountry->isExist('ID', $this->_sData['COUNTRY_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid country.';
				}

				/* Check for valid Province */
				if(!$this->_modelProvince->isExist('ID', $this->_sData['PROVINCE_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid province.';
				}

				/* Check for valid City */
				if(!$this->_modelCity->isExist('ID', $this->_sData['CITY_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid city.';
				}

				if(!$error) {
					try {
						$where = array();
						$where[] = $this->_model->getAdapter()->quoteInto('TRAINING_ID = ?', $this->_sData['TRAINING_ID']);
						$where[] = $this->_model->getAdapter()->quoteInto('TRAINER_ID = ?', $this->_sData['TRAINER_ID']);
						if(!$this->_model->isExists($where)) {
							$this->_sData['CREATED_DATE'] = $this->_date;
							$this->_model->insert($this->_sData);
						} else {
							$this->error(101, 'Trainer already registered in this training.');
						}
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
				$id = $this->_enc->base64decrypt($this->_sData['ID']);
				$roleId = $this->_enc->base64decrypt($this->_sData['ROLE_ID']);
				$countryId = $this->_enc->base64decrypt($this->_sData['COUNTRY_ID']);
				$provinceId = $this->_enc->base64decrypt($this->_sData['PROVINCE_ID']);
				$cityId = $this->_enc->base64decrypt($this->_sData['CITY_ID']);

				try {
					$error = false;
					$errorMsg = array();

					/* Check for valid Role */
					if(!$this->_modelRole->isExist('ID', $roleId)) {
						$error = true;
						$errorMsg[] = 'Invalid role.';
					}

					/* Check for valid Country */
					if(!$this->_modelCountry->isExist('ID', $countryId)) {
						$error = true;
						$errorMsg[] = 'Invalid country.';
					}

					/* Check for valid Province */
					if(!$this->_modelProvince->isExist('ID', $provinceId)) {
						$error = true;
						$errorMsg[] = 'Invalid province.';
					}

					/* Check for valid City */
					if(!$this->_modelCity->isExist('ID', $cityId)) {
						$error = true;
						$errorMsg[] = 'Invalid city.';
					}

					if(!$error) {
						try {
							$this->_model->update(array(
								'ROLE_ID' => $roleId,
								'COUNTRY_ID' => $countryId,
								'PROVINCE_ID' => $provinceId,
								'CITY_ID' => $cityId
								), $this->_model->getAdapter()->quoteInto('ID = ?', $id));
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
				} catch(Exception $e) {
					$this->exception($e);
				}
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
}