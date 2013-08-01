<?php

class Trainingparticipants_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_unique;
	protected $_required;
	protected $_sData;
	protected $_ids;

	protected $_modelParticipants;
	protected $_modelPositions;
	protected $_modelTrTrainings;
	protected $_modelOrganizations;

	public function init()
	{
		$this->_model = new trainingparticipants_Model_TrainingParticipants();
		$this->_modelView = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_unique = 'Participant';
		$this->_ids = array(
			'TRAINING_ID',
			'PARTICIPANT_ID',
			'ORGANIZATION_ID',
			'POSITION_ID'
			);
		$this->_required = $this->_ids;
		$this->_required[] = 'PRE_TEST';
		$this->_required[] = 'POST_TEST';
		$this->_required[] = 'DIFF';
		$this->_sData = array();

		$this->_modelParticipants = new participants_Model_Participants();
		$this->_modelPositions = new positions_Model_Positions();
		$this->_modelTrTrainings = new trtrainings_Model_TrTrainings();
		$this->_modelOrganizations = new organizations_Model_Organizations();
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

				/* Check for valid Participants */
				if(!$this->_modelParticipants->isExist('ID', $this->_sData['PARTICIPANT_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid participant.';
				}

				/* Check for valid Positions */
				if(!$this->_modelPositions->isExist('ID', $this->_sData['POSITION_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid position.';
				}

				/* Check for valid Trainings */
				if(!$this->_modelTrTrainings->isExist('ID', $this->_sData['TRAINING_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid training.';
				}

				/* Check for valid Organizations */
				if(!$this->_modelOrganizations->isExist('ID', $this->_sData['ORGANIZATION_ID'])) {
					$error = true;
					$errorMsg[] = 'Invalid organization.';
				}

				if(!$error) {
					try {
						$where = array();
						$where[] = $this->_model->getAdapter()->quoteInto('TRAINING_ID = ?', $this->_sData['TRAINING_ID']);
						$where[] = $this->_model->getAdapter()->quoteInto('PARTICIPANT_ID = ?', $this->_sData['PARTICIPANT_ID']);
						if(!$this->_model->isExists($where)) {
							$this->_sData['CREATED_DATE'] = $this->_date;
							$this->_model->insert($this->_sData);
						} else {
							$this->error(101, 'Participant already registered in this training.');
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

	public function readAction()
	{
		try {
			if(isset($this->_posts['TRAINING_ID'])) {
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
				$organizationId = $this->_enc->base64decrypt($this->_sData['ORGANIZATION_ID']);
				$positionId = $this->_enc->base64decrypt($this->_sData['POSITION_ID']);
				try {
					$error = false;
					$errorMsg = array();

					/* Check for valid Positions */
					if(!$this->_modelPositions->isExist('ID', $positionId)) {
						$error = true;
						$errorMsg[] = 'Invalid position.';
					}
					/* Check for valid Organizations */
					if(!$this->_modelOrganizations->isExist('ID', $organizationId)) {
						$error = true;
						$errorMsg[] = 'Invalid organization.';
					}
					if(!$error) {
						try {
							$this->_model->update(array(
								'ORGANIZATION_ID' => $organizationId,
								'POSITION_ID' => $positionId,
								'PRE_TEST' => $this->_sData['PRE_TEST'],
								'POST_TEST' => $this->_sData['POST_TEST'],
								'DIFF' => $this->_sData['DIFF']
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