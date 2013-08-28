<?php

class Trainingparticipants_Model_TrainingParticipants extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'TR_TRAINING_PARTICIPANTS';
	protected $_primary = array('ID','TRAINING_ID','PARTICIPANT_ID','POSITION_ID','ORGANIZATION_ID');
}