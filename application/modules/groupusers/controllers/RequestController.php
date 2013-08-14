<?php

class Groupusers_RequestController extends MyIndo_Controller_Action
{

	protected $_api;

	public function init()
	{
		$this->_api = new MyIndo_Api_Request();
	}

	public function readAction()
	{
		try {
			if(isset($this->_posts['GROUP_ID']) && !empty($this->_posts['GROUP_ID'])) {
				$data = $this->_api->getListGroupUsers($this->_posts['GROUP_ID'], $this->_order);
				$this->_data = $data;
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['GROUP_ID']) && isset($this->_posts['USER_ID']) && !empty($this->_posts['GROUP_ID']) && !empty($this->_posts['USER_ID'])) {
				
				$data = $this->_api->addGroupUser($this->_posts['GROUP_ID'], $this->_posts['USER_ID']);
				if(!$data['success']) {
					$this->error($data['error_code'], $data['error_message']);
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
			if(isset($this->_posts['GROUP_ID']) && isset($this->_posts['USER_ID']) && !empty($this->_posts['GROUP_ID']) && !empty($this->_posts['USER_ID'])) {
				
				$data = $this->_api->deleteGroupUser($this->_posts['GROUP_ID'], $this->_posts['USER_ID']);
				if(!$data['success']) {
					$this->error($data['error_code'], $data['error_message']);
				}

			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}