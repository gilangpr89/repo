<?php 

class MyIndo_Model_Privileges extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'PRIVILEGES';
	protected $_primary = array('GROUP_ID', 'MENU_ID');
}