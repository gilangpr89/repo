<?php

class City_RequestController extends MyIndo_Controller_Action
{
	public function init()
	{
		$this->_model = new city_Model_City();
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
				if(!$this->_model->isExist('NAME', $this->_posts['NAME'])) {
					
					$this->_model->insert(array(
						'NAME' => $this->_posts['NAME'],
						'CREATED_DATE' => $this->_date
						));
				} else {
					$this->error(101, 'City already registered, please input another name.');
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
			if(isset($this->_posts['query'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['NAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			$this->_data['items'] = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_model->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}