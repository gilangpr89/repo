<?php

class MyIndo_Api_Request
{
	protected $_order;
	protected $_enc;
	protected $_key;
	protected $_iv;
	protected $_where;
	
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
		
		$this->_where = array();
	}
	/**
	  * Function Name 	: getListMenu()
	  * Created Date 	: June, 17 2013
	  * Description 	: Get list menus
	  * @author 		: Gilang Pratama Putra
	  */
	public function getListMenu($groups)
	{
		try {
			$menuModel = new MyIndo_Model_Menus();
			$where = array($menuModel->getAdapter()->quoteInto('ACTIVE = ?',1));
			$list = $menuModel->getList(null,null, array('MENU_ID ASC','INDEX ASC'), $where);
			
			foreach($list as $k=>$d) {
				$list[$k]['PARENT_ID'] = $this->_enc->base64encrypt($d['PARENT_ID']);
				
				/* Check for privilege */
				if(!in_array(1, $groups)) { // ByPass for group id 1 -> Administrator
					if($list[$k]['TYPE'] == 'MENU' || $list[$k]['TYPE'] == 'SUBMENU') {
						if(!$this->hasMenuPrivilege($groups, $list[$k]['MENU_ID'])) {
							unset($list[$k]);
						}
					}
				}
			}
			
			/* Re-Structuring */
			$menus = array();
			foreach($list as $v) {
				$menus[] = $v;
			}
			
			return $this->getMenuRecursive($menus, 0);
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

	public function getTreeMenu($group_id)
	{
		try {
			$menuModel = new MyIndo_Model_Menus();
			$this->_where = array();
			$this->_where[] = $menuModel->getAdapter()->quoteInto('ACTIVE = ?',1);
			$q = $menuModel->select()->where('ACTIVE = ?', 1)->order(array('MENU_ID ASC', 'INDEX ASC'));
			$list = $q->query()->fetchAll();
			return $this->getTreeMenuRecursive($list, 0, $group_id);
		} catch(Exception $e) {
			return array();
		}
	}
	
	protected function getTreeMenuRecursive($data, $parent = 0, $group_id)
	{
		$tree = array();
		if(count($data) > 0) {
// 			$parentDefault = ($parent == 0) ? $data[0]['PARENT_ID'] : $parent;
			foreach($data as $index => $menu) {
				if($menu['PARENT_ID'] == $parent) {
					$i = count($tree);
					
					$tree[$i]['text'] = $menu['MENU_TITLE'];
					$tree[$i]['data'] = $this->getTreeMenuRecursive($data, $menu['MENU_ID'], $group_id);
					$tree[$i]['MENU_ID'] = $this->_enc->base64encrypt($menu['MENU_ID']);
					// $tree[$i]['id'] = strtolower($menu['TYPE']) . '-' . $menu['MENU_ID'];
					
					if(count($tree[$i]['data']) == 0/* && $menu['PARENT_ID'] != $parentDefault*/) {
						unset($tree[$i]['data']);
						$tree[$i]['leaf'] = true;
					} else {
						$tree[$i]['expanded'] = true;
					}
					
					$tree[$i]['checked'] = $this->getStatusPrivilege($menu['MENU_ID'], $group_id);
				}
			}
			return $tree;
		} else {
			return array();
		}
	}
	
	protected function hasMenuPrivilege($groups, $menu_id)
	{
		$hasAccess = false;
		$privilegesModel = new MyIndo_Model_Privileges();
		foreach($groups as $group) {
			$where = array();
			$where[] = $privilegesModel->getAdapter()->quoteInto('GROUP_ID = ?', $group);
			$where[] = $privilegesModel->getAdapter()->quoteInto('MENU_ID = ?', $this->_enc->base64decrypt($menu_id));
			if($privilegesModel->count($where) > 0) {
				$hasAccess = true;
			}
		}
		return $hasAccess;
	}
	
	protected function getStatusPrivilege($menu_id, $group_id)
	{
		$privilegesModel = new MyIndo_Model_Privileges();
		$this->_where = array();
		$this->_where[] = $privilegesModel->getAdapter()->quoteInto('MENU_ID = ?', $menu_id);
		$this->_where[] = $privilegesModel->getAdapter()->quoteInto('GROUP_ID = ?', $group_id);
		return ($privilegesModel->count($this->_where) > 0) ? true : false;
	}
	
	/**
	  * Function Name 	: getActions()
	  * Params 			: $menuId = int
	  * Created Date 	: June, 17 2013
	  * Description 	: Get Menu Actions
	  * @author 		: Gilang Pratama Putra
	  */
	public function getActions($menuId, $order, $groups)
	{
		$menuId = $this->_enc->base64decrypt($menuId);
		$menuModel = new MyIndo_Model_Menus();
		$where = array(
				$menuModel->getAdapter()->quoteInto('PARENT_ID = ?', $menuId),
				$menuModel->getAdapter()->quoteInto('TYPE = ?', 'ACTION')
				);
		$count = $menuModel->count($where);
		$data = $menuModel->getList($count, 0, $order, $where);
		
		/* Check for privilege */
		
		foreach($data as $k=>$v) {
			if(!in_array(1, $groups)) {
				$data[$k]['HAS_ACCESS'] = $this->hasMenuPrivilege($groups, $v['MENU_ID']);
			} else {
				$data[$k]['HAS_ACCESS'] = true;
			}
		}
		return $data;
	}
	
	public function getUserGroups($userId)
	{
		$groupUserModel = new MyIndo_Model_GroupUser();
		$groups = array();
		$q = $groupUserModel->select()
		->from($groupUserModel->getTableName(), array('GROUP_ID'))
		->where('USER_ID = ?', $userId);
		$result = $q->query()->fetchAll();
		foreach($result as $v) {
			$groups[] = $v['GROUP_ID'];
		}
		return $groups;
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