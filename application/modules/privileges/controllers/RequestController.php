<?php

class Privileges_RequestController extends MyIndo_Controller_Action
{
	protected $_modelGroups;
	protected $_isAdmin;

	public function init()
	{
		$this->_model = new MyIndo_Model_Menus();
		$this->_modelGroups = new MyIndo_Model_Groups();
		$this->_isAdmin = false;
	}

	public function readAction()
	{
		try {
			if(isset($this->_posts['GROUP_ID'])) {
				$groupId = $this->_enc->base64decrypt($this->_posts['GROUP_ID']);
				$query = $this->_modelGroups->select()->where('GROUP_ID = ?', $groupId);
				
				if($query->query()->rowCount() > 0) {
					$data = $query->query()->fetch();
					$this->_isAdmin = ($data['NAME'] == 'Administrator') ? true : false;
					
				} else {
					$this->error(101, 'Group not found.');
				}

			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}