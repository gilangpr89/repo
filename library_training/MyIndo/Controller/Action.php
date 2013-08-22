<?php

Class MyIndo_Controller_Action extends Zend_Controller_Action
{
	protected $_login;
	protected $_hasAccess;
	protected $_success;
	protected $_error_code;
	protected $_error_message;
	protected $_data;
	protected $_posts;
	protected $_date;
	protected $_limit; //
	protected $_start; //
	protected $_order; //
	protected $_where;
	protected $_totalCount;

	/* User Auth */
	protected $_authKey;
	protected $_token;
	protected $_groups;
	
	/* Encryption Class */
	protected $_enc;
	protected $_key;
	protected $_iv;

	public function preDispatch()
	{
		if(!$this->isPost() || !$this->isAjax()) {
			$this->error(901);
		}
	}

	public function postDispatch()
	{
		if($this->isAjax() && $this->isPost()) {

			if(isset($this->_posts['format'])) {
				if($this->_posts['format'] == 'json') {
					$this->json();
				}
			} else {
				$this->json();
			}

		} else {

			echo Zend_Json::encode(array(
			'serviceName' => 'MyIndo'
			));

		}
	}

	function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{
		parent::__construct($request, $response, $invokeArgs);
		// Disable view layout :
		$this->_helper->layout()->disableLayout();

		// Disable view renderer :
		$this->_helper->viewRenderer->setNoRender(true);

		// Set default $_login :
		$this->_login = true;

		// Set default $_hasAccess :
		$this->_hasAccess = true;

		// Set default $_success :
		$this->_success = true;

		// Set default $_error_code :
		$this->_error_code = 0;

		// Set default $_error_message : 
		$this->_error_message = '';

		// Set default $_data :
		$this->_data = array();

		// Set default $_posts :
		if($this->isPost()) {
			$this->_posts = $this->getRequest()->getPost();
		} else {
			$this->_posts = array();
		}

		// Set default $_date :
		$this->_date = date('Y-m-d H:i:s');

		// Set default $_limit :
		if(isset($this->_posts['limit'])) {
			if(is_numeric($this->_posts['limit'])) {
				if($this->_posts['limit'] >= 0) {
					$this->_limit = $this->_posts['limit'];
				} else {
					$this->_limit = 25;
				}
			} else {
				$this->_limit = 25;
			}
		} else {
			$this->_limit = 25;
		}

		// Set default $_start :
		if(isset($this->_posts['start'])) {
			if(is_numeric($this->_posts['start'])) {
				if($this->_posts['start'] >= 0) {
					$this->_start = $this->_posts['start'];
				} else {
					$this->_start = 0;
				}
			} else {
				$this->_start = 0;
			}
		} else {
			$this->_start = 0;
		}

		// Set default $_order :
		if(isset($this->_posts['sort'])) {
			$sort = Zend_Json::decode(str_replace("\\","",$this->_posts['sort']));
			if(isset($sort[0]['property']) && isset($sort[0]['direction'])) {
				$this->_order = $sort[0]['property'] . ' ' . $sort[0]['direction'];
			} else {
				$this->_order = null;
			}
		} else {
			$this->_order = null;
		}

		// Set default $_totalCount :
		$this->_totalCount = 0;

		// Set default $_where :
		$this->_where = array();
		
		
		/* Encryption Class - init */
		
		$config = Zend_Registry::get('config');
		$enc = $config->get('enc');

		// Set default $_key;
		$this->_key = md5($enc->get('key'));
		
		// Set default $_iv;
		$this->_iv = md5($enc->get('iv'));
		
		// init $_enc;
		$this->_enc = new MyIndo_Encryption_Aes($this->_key, $this->_iv);

		// Set default $_authKey;
		$this->_authKey = $this->view->authKey;

		// Set default $_token;
		$this->_token = '';

		// Set default $_groups:
		$this->_groups = array();
	}

	public function indexAction()
	{
		echo Zend_Json::encode(array(
			'serviceName' => 'MyIndo'
			));
		die;
	}

	public function isPost()
	{
		return $this->getRequest()->isPost();
	}

	public function isAjax()
	{
		return $this->getRequest()->isXmlHttpRequest();
	}

	public function json()
	{
		$json = array(
			'authKey'		=> $this->_authKey,
			// 'token'			=> $this->_token,
			// 'groups'		=> $this->_groups,
			'login' 		=> $this->_login,
			'hasAccess' 	=> $this->_hasAccess,
			'success' 		=> $this->_success,
			'error_code' 	=> $this->_error_code,
			'error_message'	=> $this->_error_message,
			'data' 			=> ($this->_error_code == 0) ? $this->_data : array()
			);
		$replacer = array(
				"\\u0000"
				);
		header('Content-Type: application/json');
		$jsonStr = str_replace($replacer, "", Zend_Json::encode($json));
		echo $jsonStr;
		//echo base64_encode($jsonStr);
	}

	public function exception($e)
	{
		$this->_success = false;
		$this->_error_code = $e->getCode();
		$this->_error_message = $e->getMessage();
	}

	public function error($error_code, $error_message = null)
	{
		$this->_success = false;
		$this->_error_code = $error_code;
		$this->_error_message = (is_null($error_message)) ? $this->_getErrorMessage($error_code) : $error_message;
	}

	protected function _getErrorMessage($error_code)
	{
		switch($error_code) {
			case 101:
				return 'Data already exist.';
				break;
			case 102:
				return 'Data does not exist';
				break;
			case 901:
				return 'Invalid request.';
				break;
			default:
				return 'Unknown error.';
		}
	}

	protected function _generateAuthKey()
	{
		$obj = Zend_Auth::getInstance();
		$active_user = $obj->getIdentity();

		/* Get Detail User */
		$usersModel = new MyIndo_Model_Users();
		$users = $usersModel->getDetail(array(
			$usersModel->getAdapter()->quoteInto('USERNAME = ?', $active_user)
			));

		// Set $_authKey;
		$this->_authKey = $users['USER_ID'];

		// Set $_token;
		$this->_token = $this->_enc->base64encrypt(microtime(true));

		// Set $_groups;
		$this->_groups = array();
	}
}