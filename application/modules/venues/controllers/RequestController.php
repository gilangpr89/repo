<?php

class Venues_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_unique;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_model = new venues_Model_Venues();
		$this->_modelView = new venues_Model_VenuesView();
		$this->_unique = 'Venue';
		$this->_required = array(
			'CITY_ID',
			'PROVINCE_ID',
			'COUNTRY_ID',
			'NAME',
			'PHONE_NO1',
			'PHONE_NO2',
			'EMAIL1',
			'EMAIL2',
			'WEBSITE',
			'ADDRESS'
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
				$this->_sData['CITY_ID'] = $this->_enc->base64decrypt($this->_sData['CITY_ID']);
				$this->_sData['PROVINCE_ID'] = $this->_enc->base64decrypt($this->_sData['PROVINCE_ID']);
				$this->_sData['COUNTRY_ID'] = $this->_enc->base64decrypt($this->_sData['COUNTRY_ID']);
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
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['query'] . '%');
			}
			if(isset($this->_posts['NAME']) && !empty($this->_posts['NAME'])) {
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			if(isset($this->_posts['CITY_ID']) && !empty($this->_posts['CITY_ID'])) {
				$cityId = $this->_enc->base64decrypt($this->_posts['CITY_ID']);
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('CITY_ID = ?', (int)$cityId);
			}
			if(isset($this->_posts['PROVINCE_ID'])) {
				$provinceId = $this->_enc->base64decrypt($this->_posts['PROVINCE_ID']);
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('PROVINCE_ID = ?', (int)$provinceId);
			}
			if(isset($this->_posts['COUNTRY_ID']) && !empty($this->_posts['COUNTRY_ID'])) {
				$countryId = $this->_enc->base64decrypt($this->_posts['COUNTRY_ID']);
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('COUNTRY_ID = ?', (int)$countryId);
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
				$this->_sData['CITY_ID'] = $this->_enc->base64decrypt($this->_sData['CITY_ID']);
				$this->_sData['PROVINCE_ID'] = $this->_enc->base64decrypt($this->_sData['PROVINCE_ID']);
				$this->_sData['COUNTRY_ID'] = $this->_enc->base64decrypt($this->_sData['COUNTRY_ID']);

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
			if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
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