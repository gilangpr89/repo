<?php

class MyIndo_Api_Request
{
	protected $_order;
	protected $_enc;
	protected $_key;
	protected $_iv;
	
	public function __construct()
	{
		// Set default $_order :
		if(isset($this->_posts['sort'])) {
			$sort = Zend_Json::decode($this->_posts['sort']);
			if(isset($sort[0]['property']) && isset($sort[0]['direction'])) {
				$this->_order = $sort[0]['property'] . ' ' . $sort[0]['direction'];
			} else {
				$this->_order = null;
			}
		} else {
			$this->_order = null;
		}

		$config = Zend_Registry::get('config');
        $enc = $config->get('enc');

		// Set default $_key :
		$this->_key = md5($enc->get('key', 'MyIndo_Private_KEY'));
		
		// Set default $_iv :
		$this->_iv = md5($enc->get('iv', 'MyIndo_Private_KEY'));
		
		// initialize $_enc model :
		$this->_enc = new MyIndo_Encryption_Aes($this->_key, $this->_iv);
	}
	/**
	  * Function Name 	: getListMenu()
	  * Created Date 	: June, 17 2013
	  * Description 	: Get list menus
	  * @author 		: Gilang Pratama Putra
	  */
	public function getListMenu()
	{
		try {
			$menuModel = new MyIndo_Model_Menus();
			$where = array($menuModel->getAdapter()->quoteInto('ACTIVE = ?',1));
			$list = $menuModel->getList(null,null, 'INDEX ASC', $where);
			foreach($list as $k=>$d) {
				$list[$k]['PARENT_ID'] = $this->_enc->base64encrypt($d['PARENT_ID']);
			}
			return $this->getMenuRecursive($list);
		} catch(Exception $e) {
			return array();
		}
	}

	/**
	  * Function Name 	: getMenuRecursive()
	  * Params 			: $menus = array(), $parent = int
	  * Created Date 	: June, 17 2013
	  * Description 	: Create recursive menu
	  * @author 		: Gilang Pratama Putra
	  */
	protected function getMenuRecursive($menus, $parent = 0)
	{
		$tree = array();
		$parentDefault = $menus[0]['PARENT_ID'];
		foreach($menus as $index => $menu) {
			if($menu['PARENT_ID'] == $parent && $menu['TYPE'] != 'ACTION') {
				$idx = count($tree);
				$tree[$idx] = array(
					'text'		=> $menu['MENU_TITLE'],
					'MENU_ID'	=> $menu['MENU_ID'],
					'PARENT_ID'	=> $menu['PARENT_ID'],
					'ACTION' 	=> $menu['ACTION'],
					'data' 		=> $this->getMenuRecursive($menus, $menu['MENU_ID']),
					'TYPE'		=> $menu['TYPE']
					);
				if(count($tree[$idx]['data']) == 0 && $menu['PARENT_ID'] != $parentDefault) {
					unset($tree[$idx]['data']);
					$tree[$idx]['leaf'] = true;
				} else {
					$tree[$idx]['expanded'] = true;
				}
			}
		}
		return $tree;
	}
	
	/**
	  * Function Name 	: getActions()
	  * Params 			: $menuId = int
	  * Created Date 	: June, 17 2013
	  * Description 	: Get Menu Actions
	  * @author 		: Gilang Pratama Putra
	  */
	public function getActions($menuId, $order)
	{
		$menuId = $this->_enc->base64decrypt($menuId);
		$menuModel = new MyIndo_Model_Menus();
		$where = array(
				$menuModel->getAdapter()->quoteInto('PARENT_ID = ?', $menuId),
				$menuModel->getAdapter()->quoteInto('TYPE = ?', 'ACTION')
				);
		$count = $menuModel->count($where);
		$data = $menuModel->getList($count, 0, $order, $where);
		return $data;
	}

	public function getListGroupUsers($groupId, $order)
	{
		$groupId = $this->_enc->base64decrypt($groupId);
		$model = new MyIndo_Model_GroupUserView();
		$where = array($model->getAdapter()->quoteInto('GROUP_ID = ?', $groupId));
		$count = $model->count($where);
		$data['items'] = $model->getList($count, 0, $order, $where);
		$data['totalCount'] = $count;
		return $data;
	}

	public function addGroupUser($groupId, $userId)
	{
		$groupId = $this->_enc->base64decrypt($groupId);
		$userId = $this->_enc->base64decrypt($userId);
		$groupModel = new MyIndo_Model_Groups();
		$userModel = new MyIndo_Model_Users();
		$groupUserModel = new MyIndo_Model_GroupUser();
		$data = array(
			'success' => true,
			'error_code' => 0,
			'error_message' => ''
			);

		if($groupModel->isExist('GROUP_ID', $groupId)) {
			if($userModel->isExist('USER_ID', $userId)) {
				try {
					$where = array(
						$groupUserModel->getAdapter()->quoteInto('GROUP_ID = ?', $groupId),
						$groupUserModel->getAdapter()->quoteInto('USER_ID = ?', $userId)
						);
					if(!$groupUserModel->isExists($where)) {
						$groupUserModel->insert(array(
							'GROUP_ID' => $groupId,
							'USER_ID' => $userId
							));
					} else {
						$data['success'] = false;
						$data['error_code'] = 101;
						$data['error_message'] = 'User already registered.';
					}
				} catch(Exception $e) {
					$data['success'] = false;
					$data['error_code'] = $e->getCode();
					$data['error_message'] = $e->getMessage();
				}
			} else {
				$data['success'] = false;
				$data['error_code'] = 102;
				$data['error_message'] = 'User not found.';
			}
		} else {
			$data['success'] = false;
			$data['error_code'] = 102;
			$data['error_message'] = 'Group not found.';
		}
		return $data;
	}

	public function deleteGroupUser($groupId, $userId)
	{
		$groupId = $this->_enc->base64decrypt($groupId);
		$userId = $this->_enc->base64decrypt($userId);
		$groupModel = new MyIndo_Model_Groups();
		$userModel = new MyIndo_Model_Users();
		$groupUserModel = new MyIndo_Model_GroupUser();
		$data = array(
			'success' => true,
			'error_code' => 0,
			'error_message' => ''
			);
		try {
			$detailGroup = $groupModel->getDetail(array($groupModel->getAdapter()->quoteInto('GROUP_ID = ?', $groupId)));
			$detailUser = $userModel->getDetail(array($userModel->getAdapter()->quoteInto('USER_ID = ?', $userId)));
			if($detailGroup['NAME'] == 'Administrator' && $detailUser['USERNAME'] == 'admin') {
				$data['success'] = false;
				$data['error_code'] = 901;
				$data['error_message'] = 'You cannot delete this user.';
			} else {
				$where = array(
						$groupUserModel->getAdapter()->quoteInto('GROUP_ID = ?', $groupId),
						$groupUserModel->getAdapter()->quoteInto('USER_ID = ?', $userId)
						);
				$groupUserModel->delete($where);
			}
		} catch(Exception $e) {
			$data['success'] = false;
			$data['error_code'] = $e->getCode();
			$data['error_message'] = $e->getMessage();
		}
		return $data;
	}
}