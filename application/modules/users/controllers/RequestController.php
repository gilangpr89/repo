<?php

class Users_RequestController extends MyIndo_Controller_Action
{
	protected $_model;

	public function init()
	{
		$this->_model = new MyIndo_Model_Users();
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['USERNAME']) && 
				isset($this->_posts['PASSWORD']) && 
				isset($this->_posts['PASSWORD2']) && 
				isset($this->_posts['EMAIL'])) {

				if(!$this->_model->isExist('USERNAME', $this->_posts['USERNAME'])) {
					$this->_posts['IP_ADDRESS'] = '127.0.0.1';
					$this->_posts['LAST_IP_ADDRESS'] = '127.0.0.1';
					$this->_posts['LAST_LOGIN'] = '1990-01-01 00:00:00';
					$this->_posts['CREATED_DATE'] = $this->_date;
					$this->_posts['PASSWORD'] = MyIndo_Encryption_Password::makePassword($this->_posts['PASSWORD']);
					unset($this->_posts['PASSWORD2']);
					$this->_model->insert($this->_posts);
				} else {
					$this->error(101, 'Username already used, please try another usename.');
				}

			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function readAction()
	{
		try {
			if(isset($this->_posts['query'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('USERNAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['USERNAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('USERNAME LIKE ?', '%' . $this->_posts['USERNAME'] . '%');
			}
			if(isset($this->_posts['EMAIL'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('EMAIL LIKE ?', '%' . $this->_posts['EMAIL'] . '%');
			}
			$data = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$totalCount = $this->_model->count($this->_where);
			$this->_data['items'] = $data;
			$this->_data['totalCount'] = $totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			if(isset($this->_posts['USERNAME']) && isset($this->_posts['PASSWORD']) && isset($this->_posts['PASSWORD2']) && isset($this->_posts['EMAIL']) && isset($this->_posts['USER_ID'])) {

				$userId = $this->_enc->base64decrypt($this->_posts['USER_ID']);
				$this->_where[] = $this->_model->getAdapter()->quoteInto('USER_ID = ?', $userId);

				$userDetails = $this->_model->getDetail($this->_where);
				$availUsername = false;
				$isAdmin = false;

				if($this->_posts['USERNAME'] != $userDetails['USERNAME']) {
					$availUsername = ($this->_model->isExist('USERNAME', $this->_posts['USERNAME']));
					if($userDetails['USERNAME'] == 'admin') {
						$isAdmin = true;
					}
				}

				if($availUsername) {
					$this->error(101, 'Username already registered, updating user aborted.');
				} else {
					$updates = array(
						'USERNAME' => $this->_posts['USERNAME'],
						'PASSWORD' => MyIndo_Encryption_Password::makePassword($this->_posts['PASSWORD']),
						'EMAIL' => $this->_posts['EMAIL']
						);
					if($isAdmin) {
						unset($updates['USERNAME']);
						$this->error(10082, 'Another update success, but you cannot change this user`s username.');
					}
					$this->_model->update($updates, $this->_model->getAdapter()->quoteInto('USER_ID = ?', $userId));
				}

			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function destroyAction()
	{
		try {
			if(isset($this->_posts['USER_ID'])) {
				$userId = $this->_enc->base64decrypt($this->_posts['USER_ID']);
				$q = $this->_model->select()->where('USER_ID = ?', $userId);
				if($q->query()->rowCount()) {
					$detailUsers = $q->query()->fetch();
					if($detailUsers['USERNAME'] != 'admin') {
						$this->_model->delete($this->_model->getAdapter()->quoteInto('USER_ID = ?', $userId));
					} else {
						$this->error(10082, 'Sorry, you cannot delete this user.');
					}
				} else {
					$this->error(101, 'Invalid user.');
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}