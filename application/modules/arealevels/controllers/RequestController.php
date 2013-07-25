<?php

class Arealevels_RequestController extends MyIndo_Controller_Action
{

	protected $_modelView;
	protected $_unique;

	public function init()
	{
		$this->_model = new arealevels_Model_AreaLevels();
		$this->_modelView = new arealevels_Model_AreaLevelsView();
		$this->_unique = 'Area Level';
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['NAME']) && isset($this->_posts['TYPE'])) {
				if(!$this->_model->isExist('NAME', $this->_posts['NAME'])) {
					
					$this->_model->insert(array(
						'NAME' => $this->_posts['NAME'],
						'TYPE' => $this->_posts['TYPE'],
						'CREATED_DATE' => $this->_date
						));
				} else {
					$this->error(101, $this->_unique . ' already registered, please input another name.');
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
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['NAME'])) {
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			if(isset($this->_posts['TYPE'])) {
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('TYPE LIKE ?', '%' . $this->_posts['TYPE'] . '%');
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
			if(isset($this->_posts['ID']) && isset($this->_posts['NAME']) && isset($this->_posts['TYPE'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				$name = $this->_posts['NAME'];
				$valid = true;
				$q = $this->_model->select()->where('ID = ?', $id);
				if($q->query()->rowCount() > 0) {
					$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $name . '%');
					$details = $q->query()->fetch();
					if($this->_model->isExist('NAME', $name)) {
						if($details['NAME'] != $name) {
							$valid = false;
						}
					}
					if($valid) {
						$this->_model->update(array(
							'NAME' => $name,
							'TYPE' => $this->_posts['TYPE']
							), $this->_model->getAdapter()->quoteInto('ID = ?', $id));
					} else {
						$this->error(101, $this->_unique . ' already registered.');
					}
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