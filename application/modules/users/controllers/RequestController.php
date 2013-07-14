<?php

class Users_RequestController extends MyIndo_Controller_Action
{
	protected $_model;

	public function init()
	{
		$this->_model = new MyIndo_Model_Users();
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['USERNAME']) && 
				isset($this->_posts['PASSWORD']) && 
				isset($this->_posts['PASSWORD2']) && 
				isset($this->_posts['EMAIL'])) {

				if(!$this->_model->isExist('USERNAME', $this->_posts['USERNAME'])) {
					$this->_posts['IP_ADDRESS'] = '127.0.0.1';
					$this->_posts['LAST_IP_ADDRESS'] = '127.0.0.1';
					$this->_posts['LAST_LOGIN'] = '1990-01-01 00:00:00';
					$this->_posts['CREATED_DATE'] = $this->_date;
					$this->_posts['PASSWORD'] = MyIndo_Encryption_Password::makePassword($this->_posts['PASSWORD']);
					unset($this->_posts['PASSWORD2']);
					$this->_model->insert($this->_posts);
				} else {
					$this->error(101, 'Username already used, please try another usename.');
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
			$where = array();
			if(isset($this->_posts['query'])) {
				$where[] = $this->_model->getAdapter()->quoteInto('USERNAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			$data = $this->_model->getList($this->_limit, $this->_start, $this->_order, $where);
			$totalCount = $this->_model->count();
			$this->_data['items'] = $data;
			$this->_data['totalCount'] = $totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}