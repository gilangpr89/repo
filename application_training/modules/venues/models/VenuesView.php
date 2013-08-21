<?php

class Venues_Model_VenuesView extends MyIndo_Db_Table_Abstract
{
	protected $_name = 'MS_VENUES_VIEW';
	protected $_primary = array('ID','CITY_ID','PROVINCE_ID','COUNTRY_ID');
}