<?php

class MyIndo_Model_GroupUser extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'GROUP_USER';
	protected $_primary = array('GROUP_ID', 'USER_ID');
}