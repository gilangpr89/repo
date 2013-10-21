<?php
require_once APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Organizations_RequestController extends MyIndo_Controller_Action
{
	protected $_modelView;
	protected $_modelTraining;
	protected $_msTraining;
	protected $_msCountry;
	protected $_modelParticipant;
	protected $_unique;
	protected $_required;
	protected $_sData;
	protected $_modelUpload;
	protected $_modelUploadView;
	protected $_upload_path;
	protected $_allowed_file_extension;
	protected $_max_file_size;

	public function init()
	{
		$this->_upload_path = APPLICATION_PATH . '/../public_html/uploads/';
		$this->_allowed_file_extension = array('ppt','pptx','doc','docx','xls','xlsx','pdf');
		$this->_max_file_size = 10 * 1024 * 1024;
		$this->_modelUpload = new organizations_Model_OrganizationsUpload();
		$this->_modelUploadView = new organizations_Model_OrganizationsUploadView();
		$this->_msTraining = new trainings_Model_Trainings();
		$this->_msCountry = new countries_Model_Country();
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
// 			if(isset($this->_posts['NAME']) && !empty($this->_posts['NAME'])) {
// 				$this->_where[] = $this->_modelView->getAdapter()->quoteInto('NAME LIKE ?', '%' . $this->_posts['NAME'] . '%');
// 			}
		    $this->_data['items'] = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelTraining->count($this->_where);
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
	
	public function uploadAction()
	{
		$upload = new Zend_File_Transfer_Adapter_Http();
		$upload->setDestination($this->_upload_path);
		$this->_success = true;
		$this->_error_code = 0;
		$this->_error_message = '';
		
		try {
			$fileInfo = $upload->getFileInfo();
			$fileName = $fileInfo['FILE']['name'];
		
			/* Check for file extension */
			$split = explode('.', $fileName);
			$fileExtension = $split[count($split)-1];
			if(in_array($fileExtension, $this->_allowed_file_extension)) {
				if($fileInfo['FILE']['size'] <= $this->_max_file_size) {
					$organizationId = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
					$trainingId = $this->_enc->base64decrypt($this->_posts['TRAINING_ID']);
					$file = $this->_posts['FILE_NAME'];
		
					/* Check for exist training */
					$q = $this->_modelUpload->select()
					          ->where('FILE_NAME = ?', $file);
					if($q->query()->rowCount() < 1) {
						try {
							$rename = $this->_posts['FILE_NAME'] . '_' . date('Y_m_d_H_i_s') . '.' . $fileExtension;
							$upload->addFilter('Rename', $this->_upload_path . $rename);
							$upload->receive();
							// echo $this->_upload_path . $this->_posts['FILE_NAME'] . '_' . date('Y_m_d_H_i_s') . '.' . $fileExtension;
							// //$upload->addFilter('Rename', APPLICATION_PATH.'/../public/images/avatars/'.$userId.'.jpg');
							$this->_modelUpload->insert(array(
									'ORGANIZATION_ID' => $organizationId,
									'FILE_NAME'	=> $this->_posts['FILE_NAME'],
									'TRAINING_ID' => $trainingId,
									'FILE_SIZE' => $fileInfo['FILE']['size'],
									'FILE_MIME_TYPE' => $fileInfo['FILE']['type'],
									'FILE_PATH' => 'uploads/' . $rename,
									'CREATED_DATE' => $this->_date
							));
						} catch(Exception $e) {
							$this->exception($e);
						}
		
					} else {
						$this->error(101, 'Doc Name Already Exist.');
					}
				} else {
					$this->error(1022, 'File exceeded maximum file size (10MB)');
				}
			} else {
				$this->error(1021, 'Not allowed file extension \'' . $fileExtension . '\'.');
			}
		
			$this->json();die;
		} catch(Zend_File_Transfer_Exception $e) {
			$this->exception($e);
		}
	}
	
	public function fileAction()
	{
		try {
			if(isset($this->_posts['ORGANIZATION_ID']) && !empty($this->_posts['ORGANIZATION_ID'])) {
				$organizationId = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
				$this->_where[] = $this->_modelUpload->getAdapter()->quoteInto('ORGANIZATION_ID = ?', $organizationId);
			
// 			$organizationId = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
// 			print_r($organizationId);
			$this->_data['items'] = $this->_modelUploadView->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			$this->_data['totalCount'] = $this->_modelUploadView->count($this->_where);
			}
		} catch(Exception $e) {
			$this->exception($e);
		}
	}
	
	public function deleteAction()
	{
			if(!isset($this->posts['ORGANIZATION_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['ID']);
				$oId = $this->_enc->base64decrypt($this->_posts['ORGANIZATION_ID']);
				$name = $this->_posts['FILE_NAME'];

			$q = $this->_modelUpload->select()
						->where('ID = ?', $id)
						->where('FILE_NAME = ?', $name);
			if($q->query()->rowCount() > 0) {
				$detail = $q->query()->fetch();
				try {
					/* Delete File */
					if(file_exists(APPLICATION_PATH . '/../public_html/' . $detail['FILE_PATH'])) {
						unlink(APPLICATION_PATH . '/../public_html/' . $detail['FILE_PATH']);
					}
					$query = $this->_modelUpload->delete($this->_modelUpload->getAdapter()->quoteInto('FILE_NAME = ?', $name));
				} catch(Exception $e) {
					$this->exception($e);
				}
			} else {
				$this->error(101, 'Invalid Doc.');
			}
		} else {
			$this->error(901);
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

// 			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
// 				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
// 				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
// 			}

			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_modelTraining->select()->from('TR_TRAININGS_VIEW', array('*'))
			->where('ID IN (?)', $list);
			$query = $x->query()->fetchAll();
			
			$c = array();
			foreach ($query as $key=>$value) {
				if(!isset($c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']])) {
					$c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']] = 1;
				} else {
					$c[$value['TRAINING_NAME']][$value['VENUE_COUNTRY_NAME']]++;
				}
			}
			
			$negara = $this->_msCountry->select()->from('MS_COUNTRY', array('NAME'));
			$daftar = $negara->query()->fetchAll();
			foreach ($daftar as $kunci=>$nilai) {
				$var[] = $nilai['NAME'];
			}

			/*Start Header Table */
			$push = $var;
			array_unshift($push, 'Training Name');
			
			$HeaderTable = array_unique($push);
			$headerTable = array($HeaderTable);
			
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$array = array_values($split);
			$col = array();
			for ($i = 0; $i < count($array); ++$i) {
			$col[] = array('text' => $array[$i] , 'width' => '23','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			}
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
			
			/* End Header Table */
			foreach ($var as $compare=>$buat) {

				$tes [] = $buat;
			}
// 			for ($i = 0; $i <= count($tes); ++$i) {
// 				print_r($tes[$i]);
// 			}
			$columns = array();

			if ( $c ) foreach( $c as $key=>$split ):
			$col = array();
			$col[] = array('text' => $key ,'width' => '23','height' => '5','align' => 'L','linearea' => 'LTBR',);
				foreach ($split as $keys=>$value) {
					if($keys == $tes) {
						$col[] = array('text' => $value ,'width' => '23','height' => '5','align' => 'L','linearea' => 'LTBR',);
					} else {
						$value = 0;
						$col[] = array('text' => $value ,'width' => '23','height' => '5','align' => 'L','linearea' => 'LTBR',);
					}
					}
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);

			$country = array_unique($k);
			$result =  array_map(null,$v,$k);
			$Country = array($country);


	        /* Start Store Count Result */			
			$trName2 = array_unique($v);
			foreach ($result as $x=>$y) {
				foreach ($trName2 as $key=>$row) {
					if ($y[0] == $row) {
						$string[] = '' . $y[0] .'-' . $y[1] . '';
						$stringX[] = $y[1];
							
					}
				}
			}


			$count = array_count_values($string);
			$unique = array_unique($string);
			$reindex = array_values($unique);
			foreach ($reindex as $explode) {
				$Explode = explode("-", $explode);
				$newExplode[] = $Explode[0];
				$newCount[] = $Explode[1];
			}

			$res = array_map(null,$newExplode,$newCount,$count);
			foreach ($res as $k=>$v){
// 				print_r($k);
				for ($i = 0; $i <= $k; ++$i) {
// 					print_r(($v[$i]));
				}
// 				$columns = array();
// 				$col = array();
// 				$col[] = array('text' => $v[0] ,'width' => '35','height' => '5','align' => 'L','linearea' => 'LTBR',);
// 				$col[] = array('text' => $v[1] ,'width' => '35','height' => '5','align' => 'L','linearea' => 'LTBR',);
// 				$col[] = array('text' => $v[2] ,'width' => '35','height' => '5','align' => 'L','linearea' => 'LTBR',);
// 				$columns[] = $col;
// 				$pdf->WriteTable($columns);
			}
			
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
		
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
}