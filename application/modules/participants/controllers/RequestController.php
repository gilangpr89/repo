<?php

class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_model = new participants_Model_Participants();
		$this->_modelView = new participants_Model_ParticipantsView();
		$this->_unique = 'Participant';
		$this->_required = array(
			'FNAME',
			'MNAME',
			'LNAME',
			'SNAME',
			'GENDER',
			'BDATE',
			'MOBILE_NO',
			'PHONE_NO',
			'EMAIL1',
			'EMAIL2',
			'FB',
			'TWITTER'
			);
		$this->_sData = array();
	}

	public function createAction()
	{
		try {
			$valid = true;
			foreach($this->_required as $r) {
				if(!isset($this->_posts[$r])) {
					$valid = false;
				} else {
					$this->_sData[$r] = $this->_posts[$r];
				}
			}
			if($valid) {
				$this->_sData['CREATED_DATE'] = $this->_date;
				$this->_model->insert($this->_sData);
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
			if(isset($this->_posts['query']) && !empty($this->_posts['query'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['NAME']) && !empty($this->_posts['NAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			if(isset($this->_posts['SNAME']) && !empty($this->_posts['SNAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('SNAME LIKE ?', '%' . $this->_posts['SNAME'] . '%');
			}
			if(isset($this->_posts['MOBILE_NO']) && !empty($this->_posts['MOBILE_NO'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('MOBILE_NO LIKE ?', '%' . $this->_posts['MOBILE_NO'] . '%');
			}
			if(isset($this->_posts['EMAIL1']) && !empty($this->_posts['EMAIL1'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('EMAIL1 LIKE ?', '%' . $this->_posts['EMAIL1'] . '%');
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			$this->_required[] = 'ID';
			$valid = true;
			foreach($this->_required as $r) {
				if(!isset($this->_posts[$r])) {
					$valid = false;
				} else {
					$this->_sData[$r] = $this->_posts[$r];
				}
			}
			if($valid) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_model->isExist('ID', $id)) {
					unset($this->_sData['ID']);
					$this->_model->update($this->_sData, $this->_model->getAdapter()->quoteInto('ID = ?', $id));
				} else {
					$this->error(101);
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
			if(isset($this->_posts['ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				if($this->_model->isExist('ID', $id)) {
					$this->_model->delete($this->_model->getAdapter()->quoteInto('ID = ?', $id));
				} else {
					$this->error(102);
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}