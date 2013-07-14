<?php 

class MyIndo_Api_Acl extends Zend_Controller_Plugin_Abstract
{
	protected $_objAuth;
	protected $_module;
	protected $_controller;
	protected $_action;
	protected $_session;

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$this->_objAuth = Zend_Auth::getInstance();
		$this->_module = $request->getModuleName();
		$this->_controller = $request->getControllerName();
		$this->_action = $request->getActionName();
		$this->_session = new Zend_Session_Namespace();
		
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView();

		$config = Zend_Registry::get('config');
		$enc = $config->get('enc');
		
		$json = array(
			//'authKey'		=> '',
			//'token'			=> '',
			//'groups'		=> array(),
			'login' 		=> false,
			'hasAccess' 	=> false,
			'success'		=> true,
			'error_code'	=> 0,
			'error_message'	=> '',
			//'data'			=> array('items'=>array())
		);

		if(!$this->_objAuth->hasIdentity()) {

			$json['error_code'] 	= 10081;
			$json['error_message'] 	= 'Access denied.';
			
			if($this->getRequest()->isXmlHttpRequest()) {

				if(
					($this->_module == 'users' && $this->_controller == 'login' && $this->_action == 'index')
				) {

					// -- not acl enabled ..

				} else {
					echo Zend_Json::encode($json);
					die;
				}

			} else {

				$request->setModuleName('users');
				$request->setControllerName('login');
				$request->setActionName('index');

			}

		} else {
			
			/* Check for session expired */
			$usersData = $this->_objAuth->getIdentity();
			if($usersData->EXPIRED > strtotime('now')) {
				
				$usersData->EXPIRED = strtotime('+10 minutes');
				
				$json['login'] 		= true;
				$json['hasAccess'] 	= true;
				
				$mEnc = new MyIndo_Encryption_Aes(md5($enc->get('key')), md5($enc->get('iv')));
	
				$view->authKey = $mEnc->base64encrypt($usersData->USER_ID);
				
			} else {
				
				if($this->getRequest()->isXmlHttpRequest()) {
					
					$this->_objAuth->clearIdentity();
					echo Zend_Json::encode($json);
					die;
				
				} else {

					$request->setModuleName('users');
					$request->setControllerName('login');
					$request->setActionName('logout');
					
				}
				
			}
		}

	}
}