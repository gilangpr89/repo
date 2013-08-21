<?php

class Users_LoginController extends Zend_Controller_Action
{
	protected $_posts;
    protected $_enc;
    protected $_key;
    protected $_iv;

	public function init()
	{
		if($this->getRequest()->isPost()) {
			$this->_posts = $this->getRequest()->getPost();
		} else {
			$this->_posts = array();
		}

        $config = Zend_Registry::get('config');
        $enc = $config->get('enc');

        // Set default $_key;
        $this->_key = md5($enc->get('key','MyIndo_Private_KEY'));
        
        // Set default $_iv;
        $this->_iv = md5($enc->get('key','MyIndo_Private_KEY'));
        
        // init $_enc;
        $this->_enc = new MyIndo_Encryption_Aes($this->_key, $this->_iv);
	}

	protected function _getAuthAdapter() {
    
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    
    	$authAdapter->setTableName('USERS')
    	->setIdentityColumn('USERNAME')
    	->setCredentialColumn('PASSWORD');
    	return $authAdapter;
    }

    protected function _loginProcess($data)
    {
		try {
 		   	$adapter = $this->_getAuthAdapter();
    		$adapter->setIdentity($data['USERNAME']);
    		$adapter->setCredential(MyIndo_Encryption_Password::makePassword($data['PASSWORD']));
    		$select = $adapter->getDbSelect();
    		$select->where('ACTIVE = 1');
    		$auth = Zend_Auth::getInstance();
    		$result = $auth->authenticate($adapter);
    		
    		if($result->isValid()) {
    			
    			$usersData = $adapter->getResultRowObject();
    			unset($usersData->PASSWORD);
    			
    			$usersData->EXPIRED = strtotime('+10 minutes');
    			
    			$storage = new Zend_Auth_Storage_Session();
    			$storage->write($usersData);

    			$model = new MyIndo_Model_Users();
    			$model->update(array(
    				'IP_ADDRESS' => MyIndo_Tools_IP::getIp(),
    				'LAST_IP_ADDRESS' => $usersData->IP_ADDRESS,
    				'LAST_LOGIN' => date('Y-m-d H:i:s')
    				), $model->getAdapter()->quoteInto('USER_ID = ?', $usersData->USER_ID));
    			
    			return array(
					'message' => 'Welcome back, ' . $data['USERNAME'] . '.',
					'status' => true,
    				'auth' => array(
	    				'authKey' => $this->_enc->base64encrypt($usersData->USER_ID),
	    				'token' => $this->_enc->base64encrypt($usersData->USERNAME),
	    				'groups' => array()
	    			)
    			);
    			
    		} else {
    		    		
    			return array(
					'message' => 'Invalid Username or Password',
					'status' => false
    			);
    		}
    	}catch(Exception $e) {
    	    return array(
	    		'message' => $e->getMessage(),
	    		'status' => false
    	    );
    	}
    }

	public function indexAction()
	{
		$this->_helper->layout()->disableLayout();
		if($this->getRequest()->isPost()) {
			
			if($this->getRequest()->isXmlHttpRequest()) {
				
				$this->_helper->viewRenderer->setNoRender(true);
	
				$data['USERNAME'] = (isset($this->_posts['USERNAME'])) ? $this->_posts['USERNAME'] : '';
	            $data['PASSWORD'] = (isset($this->_posts['PASSWORD'])) ? $this->_posts['PASSWORD'] : '';
	            
	            $result = $this->_loginProcess($data);
	            $success = $result['status'];
	            
	            $return = array(
	            		'data' => array(
	            				'message' => $result['message']
	            		),
	            		'success' => $success
	            );
	            if(isset($result['auth'])) {
	            	$return['data']['auth'] = $result['auth'];
	            }
	            echo Zend_Json::encode($return);
	            
			}
			
		} else {
			
			$objAuth = Zend_Auth::getInstance();
			if ($objAuth->hasIdentity()) {
				$usersData = $objAuth->getIdentity();
				if($usersData->EXPIRED < strtotime('now')) {
					$this->_redirect('/users/login/logout');
				} else {
					$this->_redirect('/');
				}
			}
		}
	}

    public function changePasswordAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $return = array(
            'hasAccess' => true,
            'success' => false,
            'login' => true,
            'error_code' => 0,
            'error_message' => ''
            );
        if($this->getRequest()->isPost()) {
            if($this->getRequest()->isXmlHttpRequest()) {
                $p = $this->getRequest()->getPost();
                if(isset($p['OLD_PASSWORD']) && isset($p['NEW_PASSWORD']) && isset($p['NEW_PASSWORD_CONF'])) {
                    if($p['NEW_PASSWORD'] == $p['NEW_PASSWORD_CONF']) {
                        $model = new MyIndo_Model_Users();
                        $q = $model->select()
                        ->where('USER_ID = ?', $this->view->USER_ID)
                        ->where('PASSWORD = ?', MyIndo_Encryption_Password::makePassword($p['OLD_PASSWORD']));
                        if($q->query()->rowCount() > 0) {
                            try {
                                $return['success'] = true;
                                $model->update(array(
                                    'PASSWORD' => MyIndo_Encryption_Password::makePassword($p['NEW_PASSWORD'])
                                    ), $model->getAdapter()->quoteInto('USER_ID = ?', $this->view->USER_ID));
                            } catch(Exception $e) {
                                $return['error_code'] = $e->getCode();
                                $return['error_message'] = $e->getMessage();
                            }
                        } else {
                            $return['error_code'] = 902;
                            $return['error_message'] = 'Invalid old password.';
                        }
                    } else {
                        $return['error_code'] = 902;
                        $return['error_message'] = 'New password does not match.';
                    }
                } else {
                    $return['error_code'] = '901.';
                    $return['error_message'] = 'Invalid request.';
                }
            } else {
                $return['error_code'] = '901.';
                $return['error_message'] = 'Invalid request.';
            }
        } else {
            $return['error_code'] = '901.';
            $return['error_message'] = 'Invalid request.';
        }
        echo Zend_Json::encode($return);
    }

	public function logoutAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $objAuth = Zend_Auth::getInstance();
        if ($objAuth->hasIdentity()) {
        	$objAuth->clearIdentity();
        }
        $this->_redirect('/users/login');
    }
}