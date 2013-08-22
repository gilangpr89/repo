<?php

class Trtrainings_Model_TrTrainingsView extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'TR_TRAININGS_VIEW';
	protected $_primary = array('ID','USER_ID','TRAINING_ID','AREA_LEVEL_ID','BENEFICIARIES_ID','FUNDING_SOURCE_ID','VENUE_ID','ORGANIZATION_ID');
}