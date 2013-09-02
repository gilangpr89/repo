<?php
require_once APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Organizations_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_modelTraining;
	protected $_modelParticipant;
	protected $_unique;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_model = new organizations_Model_Organizations();
		$this->_modelView = new organizations_Model_OrganizationsView();
		$this->_modelTraining = new trtrainings_Model_TrTrainingsView();
		$this->_modelParticipant = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_unique = 'Organization';
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
			if(isset($this->_posts['PROVINCE_ID']) && !empty($this->_posts['PROVINCE_ID'])) {
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
	
	public function detailAction()
	{
		try {
			if(isset($this->_posts['NAME']) && !empty($this->_posts['NAME'])) {
				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
			}
			$this->_data['items'] = $this->_modelView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelView->count($this->_where);
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function organizationTrainingsAction()
	{
		try {
			$list = array();
			if(isset($this->_posts['ORGANIZATION_ID']) && !empty($this->_posts['ORGANIZATION_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
				if($this->_modelTraining->isExist('ORGANIZATION_ID', $id)) {
					
					$where = array();
					/* Check for period */
					
					if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE'])) {
						$where[] = $this->_model->getAdapter()->quoteInto('SDATE >= ?', $this->_posts['START_DATE']);
						$where[] = $this->_model->getAdapter()->quoteInto('SDATE <= ?', $this->_posts['END_DATE']);
					}
					$where[] = $this->_modelTraining->getAdapter()->quoteInto('ORGANIZATION_ID = ?',$id);
					$q = $this->_modelTraining->select();
					foreach($where as $k=>$v) {
						$q->where($v);
					}
					$list = $q->query()->fetchAll();
					if(count($list) > 0) {
						$trainingIds = array();
						foreach($list as $k => $v) {
							if(!in_array($v['ID'], $trainingIds)) {
								$trainingIds[] = $v['ID'];
							}
						}

						$this->_where[] = $this->_modelTraining->getAdapter()->quoteInto('ID IN (?)', $trainingIds);
						$list = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_totalCount = $this->_modelTraining->count($this->_where);
					}
				} else {
					$this->error(101, 'Invalid Organization.');
				}
			} else {
				$this->error(101, 'Invalid Organization.');
			}
			$this->_data['items'] = $list;
			$this->_data['totalCount'] = $this->_totalCount;
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function printAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
		
		
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage('p', 'a4');
		$pdf->Ln(2);
		
		$filename ='ReportOrganization.' . date('Y-m-d-H-i-s');
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelTraining->select()
			->from('TR_TRAININGS_VIEW', array('ID'))
			->where('ORGANIZATION_ID = ?', $id);

			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
			}
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_modelTraining->select()->from('TR_TRAININGS_VIEW', array('*'))
			->where('ID IN (?)', $list);
			$query = $x->query()->fetchAll();
			 
		    $headerTable = array(
					array(
							'col1'	=> 'Training Name',
							'col2'	=> 'Organization',
							'col3'	=> 'Country',
							'col4'  => 'Province',
							'col5'  => 'City',
							'col6'  => 'Start Date',
							'col7'  => 'End Date',
					),
			);
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col2'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col3'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col4'] , 'width' => '25','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col5'] , 'width' => '25','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col6'] , 'width' => '22','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col7'] , 'width' => '22','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);

					foreach ($query as $row) {
						
						$columns = array();
						$col = array();
						$col[] = array('text' => ''.$row['TRAINING_NAME'],'width' => '35','height' => '5','align' => 'L','linearea' => 'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_PROVINCE_NAME'] ,'width' => '25','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_CITY_NAME'] ,'width' => '25','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['SDATE'] ,'width' => '22','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['EDATE'] ,'width' => '22','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);		
					}
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
		
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
}