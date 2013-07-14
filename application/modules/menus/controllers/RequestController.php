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
			$data = $MyIndo->getListMenu();
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
			$data = $MyIndo->getActions($this->_posts['MENU_ID'], $this->_order);
			$this->_data['items'] = $data;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}