<?php

class Groups_RequestController extends MyIndo_Controller_Action
{
	protected $_model;
	protected $_modelView;
	protected $_where;

	public function init()
	{
		$this->_model = new MyIndo_Model_Groups();
		$this->_modelView = new MyIndo_Model_GroupView();
		$this->_where = array();
	}

	public function readAction()
	{
		try {
			$data = $this->_modelView->getList($this->_limit, $this->_start, $this->_order);
			$this->_data['items'] = $data;
			$this->_data['totalCount'] = $this->_model->count();
		} catch(exception $e) {
			$this->exception($e);
		}
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
				
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME = ?', $this->_posts['NAME']);
				if($this->_model->count($this->_where) == 0) {
					$this->_model->insert(array(
						'NAME' => $this->_posts['NAME'],
						'CREATED_DATE' => $this->_date
						));
				} else {
					$this->error(101, 'Group already exits, please use another name.');
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			if(isset($this->_posts['GROUP_ID']) && isset($this->_posts['NAME'])) {
				
				$groupId = $this->_enc->base64decrypt($this->_posts['GROUP_ID']);
				$groupName = $this->_posts['NAME'];

				if($this->_model->isExist('GROUP_ID', $groupId)) {

					$this->_where[] = $this->_model->getAdapter()->quoteInto('GROUP_ID = ?', $groupId);

					$data = $this->_model->getDetail($this->_where);

					if($groupName != $data['NAME']) {

						if(!$this->_model->isExist('NAME', $groupName)) {
							if($data['NAME'] != 'Administrator') {
								$this->_model->update(array(
									'NAME' => $groupName
									), $this->_model->getAdapter()->quoteInto('GROUP_ID = ?', $groupId));
							} else {
								$this->error(901, 'You cannot update this group.');
							}
						} else {
							$this->error(101, 'Group already exist, please use another name.');
						}
					}

				} else {
					$this->error(102, 'Invalid Group, please try again.');
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
			if(isset($this->_posts['GROUP_ID']) && isset($this->_posts['NAME'])) {
				$groupId = $this->_enc->base64decrypt($this->_posts['GROUP_ID']);
				$groupName = $this->_posts['NAME'];
				$this->_where[] = $this->_model->getAdapter()->quoteInto('GROUP_ID = ?', $groupId);
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME = ?', $groupName);
				if($this->_model->isExists($this->_where)) {
					if($groupName != 'Administrator') {
						$this->_model->delete($this->_where);
					} else {
						$this->error(901, 'You cannot delete this group.');
					}
				} else {
					$this->error(102, 'Invalid Group, please try again.');
				}
			} else {
				$this->error(901);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}