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
			'PROVINCE_ID'
			);
		$this->_required = $this->_ids;
		$this->_sData = array();

		$this->_modelTraining = new trainings_Model_Trainings();
		$this->_modelTrainer = new trainers_Model_Trainers();
		$this->_modelRole = new roles_Model_Roles();
		$this->_modelCity = new cities_Model_City();
		$this->_modelProvince = new provinces_Model_Provinces();
		$this->_modelCountry = new countries_Model_Country();
	}
}