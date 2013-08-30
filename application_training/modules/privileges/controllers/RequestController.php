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
			if(isset($this->_posts['GROUP_ID']) && !empty($this->_posts['GROUP_ID'])) {
				$groupId = $this->_enc->base64decrypt($this->_posts['GROUP_ID']);
				$query = $this->_modelGroups->select()->where('GROUP_ID = ?', $groupId);
				
				if($query->query()->rowCount() > 0) {
					$data = $query->query()->fetch();
					$this->_isAdmin = ($data['NAME'] == 'Administrator') ? true : false;
					
					$MyIndo = new MyIndo_Api_Request();
					
					$data = $MyIndo->getTreeMenu($groupId);
					
					$this->_data = $data;
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
	
	public function updateAction()
	{
		try {
			if(isset($this->_posts['GROUP_ID']) && isset($this->_posts['MENUS'])) {
				
				/* Check For Group Exist */
				$groupId = $this->_enc->base64decrypt($this->_posts['GROUP_ID']);
				if($this->_modelGroups->isExist('GROUP_ID', $groupId)) {
					$privilegesModel = new MyIndo_Model_Privileges();
					
					/* Delete Privileges for this group */
					$privilegesModel->delete($privilegesModel->getAdapter()->quoteInto('GROUP_ID = ?', $groupId));
					
					$menus = Zend_Json::decode($this->_posts['MENUS']);
// 					$hasError = false;
					foreach($menus as $k => $v) {
						try {
							$privilegesModel->insert(array(
									'GROUP_ID' => $groupId,
									'MENU_ID' => $this->_enc->base64decrypt($v),
									'CREATED_DATE' => $this->_date
									));
						} catch(Exception $e) {
							
						}
					}
					$this->_data['menus'] = $menus;
				} else {
					$this->error(101);
				}
				
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}