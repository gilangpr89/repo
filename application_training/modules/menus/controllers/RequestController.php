<?php

class Menus_RequestController extends MyIndo_Controller_Action
{

	public function init()
	{
		// init..
	}

	public function readAction()
	{
		try {
			$MyIndo = new MyIndo_Api_Request();
// 			echo $this->view->USER_ID;
			$groups = $MyIndo->getUserGroups($this->view->USER_ID);
			$data = $MyIndo->getListMenu($groups);
			$this->_data = $data;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function readActionsAction()
	{
		try {
			$menuId = $this->_enc->base64decrypt($this->_posts['MENU_ID']);
			$MyIndo = new MyIndo_Api_Request();
			$groups = $MyIndo->getUserGroups($this->view->USER_ID);
			$data = $MyIndo->getActions($this->_posts['MENU_ID'], $this->_order, $groups);
			$this->_data['items'] = $data;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}