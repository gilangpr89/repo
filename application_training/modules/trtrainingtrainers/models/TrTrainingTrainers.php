<?php

class Trtrainingtrainers_Model_TrTrainingTrainers extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'TR_TRAINING_TRAINERS';
	protected $_primary = array('ID','TRAINER_ID','TRAINING_ID','ROLE_ID','CITY_ID','PROVINCE_ID','COUNTRY_ID');
}