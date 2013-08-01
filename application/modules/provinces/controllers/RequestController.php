<?php

class Provinces_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelCountry;

	public function init()
	{
		$this->_model = new provinces_Model_Provinces();
		$this->_unique = 'Province';
		$this->_modelCountry = new countries_Model_Country();
	}

	public function createAction()
	{
		try {
			if(isset($this->_posts['NAME'])) {
					
				$countryId = (isset($this->_posts['COUNTRY_ID'])) ? $this->_enc->base64decrypt($this->_posts['COUNTRY_ID']) : '';
				
				if($this->_modelCountry->isExists(array($this->_modelCountry->getAdapter()->quoteInto('ID = ?', $countryId)))) {

					if(!$this->_model->isExists(array(
						$this->_model->getAdapter()->quoteInto('COUNTRY_ID = ?', $countryId),
						$this->_model->getAdapter()->quoteInto('NAME = ?', $this->_posts['NAME'])
						))) {

							$this->_model->insert(array(
								'COUNTRY_ID' => $countryId,
								'NAME' => $this->_posts['NAME'],
								'CREATED_DATE' => $this->_date
								));

					} else {
						$this->error(101, $this->_unique . ' already registered, please input another name.');
					}
					
				} else {
					$this->error(102, 'Invalid country.' . $countryId);
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
			if(isset($this->_posts['query']) && !empty($this->_posts['query'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['COUNTRY_ID'])) {
				$countryId = $this->_enc->base64decrypt($this->_posts['COUNTRY_ID']);
				if($this->_modelCountry->isExists(array($this->_modelCountry->getAdapter()->quoteInto('ID = ?', $countryId)))) {
					$this->_where[] = $this->_model->getAdapter()->quoteInto('COUNTRY_ID = ?', $countryId);
				}
			}
			if(isset($this->_posts['NAME'])) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			$this->_data['items'] = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_model->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}

	public function updateAction()
	{
		try {
			if(isset($this->_posts['ID']) && isset($this->_posts['NAME'])) {
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
							'NAME' => $name
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