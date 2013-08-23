<?php

class Reports_Model_Report extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'TR_TRAININGS';
	protected $_primary = array('ID','TRAINING_ID');
	
	public function getTrainingid($start_date, $end_date)
	{
		$q = $this->select()
		->from('TR_TRAININGS', array('TRAINING_ID'))
		->where('SDATE >= ?', $start_date)
		->where('EDATE <= ?', $end_date);
		$list = $q->query()->fetchAll();
		return $list;
	}
}