<?php

class Menumanagements_RequestController extends MyIndo_Controller_Action
{
	public function init()
	{
		$this->_model = new MyIndo_Model_Menus();
	}
}