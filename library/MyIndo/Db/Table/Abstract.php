<?php

class MyIndo_Db_Table_Abstract extends Zend_Db_Table_Abstract
{	
	protected $_enc;
	protected $_key;
	protected $_iv;

	public function __construct()
	{
		parent::__construct();
		$config = Zend_Registry::get('config');
        $enc = $config->get('enc');
		$this->_key = md5($enc->get('key'));
		$this->_iv = md5($enc->get('iv'));
		$this->_enc = new MyIndo_Encryption_Aes($this->_key, $this->_iv);
	}

	public function getPk()
	{
		$pk = array();
		foreach($this->_primary as $k=>$d) {
			$pk[] = $d;
		}
		return $pk;
	}

	public function getList($limit = null, $offset = null, $order = null, $where = array())
	{
		try {

			$query = $this->select();

			if(!is_null($limit) && !is_null($offset) && is_numeric($limit) && is_numeric($offset)) {
				$query->limit($limit, $offset);
			}

			if(!is_null($order)) {
				if(!is_array($order)) {
					$order = array($order);
				}
				$query->order($order);
			}

			foreach($where as $index => $w) {
				$query->where($w);
			}

			$result = $query->query()->fetchAll();
			$pk = $this->getPk();

			foreach($result as $k=>$d) {
				foreach($pk as $_k=>$_d) {
					$result[$k][$_d] = $this->_enc->base64encrypt($d[$_d]);
				}
			}

			return $result;

		} catch(Exception $e) {

			return array();

		}
	}

	public function isExist($colName, $value)
	{
		try {

			$query = $this->select()->where($colName . ' = ?', $value);

			return (count($query->query()->fetchAll()) > 0) ? true : false;

		} catch(Exception $e) {
			return false;
		}
	}

	public function isExists($where = array())
	{
		try {
			$query = $this->select();
			foreach($where as $k=>$d) {
				$query->where($d);
			}
			return (count($query->query()->fetchAll()) > 0) ? true : false;
		} catch(Exception $e) {
			return false;
		}
	}

	public function count($where = array())
	{
		try {

			$query = $this->select();

			foreach($where as $k=>$d) {
				$query->where($d);
			}

			return $query->query()->rowCount();

		} catch(Exception $e) {
			return 0;
		}
	}

	public function getDetail($where = array())
	{
		try {
			$query = $this->select();

			foreach($where as $k=>$d) {
				$query->where($d);
			}

			$result = $query->query()->fetch();
			$pk = $this->getPk();

			foreach($result as $k=>$d) {
				foreach($pk as $_k=>$_d) {
					if($k == $_d) {
						$result[$k] = $this->_enc->base64encrypt($d);
					}
				}
			}
			return $result;
			
		} catch(Exception $e) {
			return array();
		}
	}
}