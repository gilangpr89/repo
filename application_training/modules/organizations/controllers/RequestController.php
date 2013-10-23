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

			/* ===================================================================================== */

			/* Get Country */
			$model = new countries_Model_Country();
			$countries = array();

			$q = $model->select()
			->from($model->getTableName(), array('NAME'))
			->distinct(true);

			$res = $q->query()->fetchAll();

			foreach($res as $k=>$d) {
				$countries[] = $d['NAME'];
			}
			/* End of : Get Country */

			/* ===================================================================================== */

			$q = $this->_modelTraining->select()
			->from($this->_modelTraining->getTableName(), array('TRAINING_NAME','VENUE_COUNTRY_NAME'));

			$res = $q->query()->fetchAll();

			$names = array();
			$trainings = array();

			foreach($res as $k=>$d) {

				if(!in_array($d['TRAINING_NAME'], $trainings)) {
					$trainings[] = $d['TRAINING_NAME'];
				}

				foreach($countries as $_k => $_d) {
					if(!isset($names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))])) {
						$names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))] = 0;
					}
				}

				if(!isset($names[$d['TRAINING_NAME']]['TOTAL'])) {
					$names[$d['TRAINING_NAME']]['TOTAL'] = 1;
				} else {
					$names[$d['TRAINING_NAME']]['TOTAL']++;
				}

				$names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($d['VENUE_COUNTRY_NAME']))]++;
				
			}
			// $fields[] = 'TOTAL';

			$data = array();
			$i = 0;
			foreach($names as $k=>$d) {
				if($i >= $this->_start && $i < $this->_limit) {
					$data[$i]['TRAINING_NAME'] = $k;
					foreach($d as $_k => $_d) {
						$data[$i][$_k] = $_d;
					}
				}
				$i++;
			}
			$this->_data['items'] = $data;
			$this->_data['totalCount'] = count($names);
			
			// $this->_data['fields'] = $fields;
			// print_r($fields);
			// print_r($names);
			// print_r($trainings);
		 	// $this->_data['items'] = $this->_modelTraining->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			// $this->_data['totalCount'] = $this->_modelTraining->count($this->_where);
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
		try {
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
		
		$pdf->SetFont('Arial','',14);
		$pdf->addPage();
		$pdf->Ln(2);
		
		    $filename ='ReportOrganization.' . date('Y-m-d-H-i-s');
		    
		    	/* ===================================================================================== */
		    
		    	/* Get Country */
		    	$model = new countries_Model_Country();
		    	$countries = array();
		    
		    	$q = $model->select()
		    	->from($model->getTableName(), array('NAME'))
		    	->distinct(true);
		    
		    	$res = $q->query()->fetchAll();
		    
		    	foreach($res as $k=>$d) {
		    		$countries[] = $d['NAME'];
		    	}

		    	/* End of : Get Country */
		    	
				    $push = $countries;
					array_unshift($push, 'Training Name');
					array_push($push, 'Total');
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
		    
		    	/* ===================================================================================== */
		    
		    	$q = $this->_modelTraining->select()
		    	->from($this->_modelTraining->getTableName(), array('TRAINING_NAME','VENUE_COUNTRY_NAME'));
		    
		    	$res = $q->query()->fetchAll();
		    
		    	$names = array();
		    	$trainings = array();
		    
		    	foreach($res as $k=>$d) {
		    
		    		if(!in_array($d['TRAINING_NAME'], $trainings)) {
		    			$trainings[] = $d['TRAINING_NAME'];
		    		}
		    
		    		foreach($countries as $_k => $_d) {
		    			if(!isset($names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))])) {
		    				$names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))] = 0;
		    			}
		    		}
		    
		    		if(!isset($names[$d['TRAINING_NAME']]['TOTAL'])) {
		    			$names[$d['TRAINING_NAME']]['TOTAL'] = 1;
		    		} else {
		    			$names[$d['TRAINING_NAME']]['TOTAL']++;
		    		}
		    
		    		$names[$d['TRAINING_NAME']]['TOTAL_' . str_replace(' ', '_', strtoupper($d['VENUE_COUNTRY_NAME']))]++;
		    
		    	}
		    	// $fields[] = 'TOTAL';

		    	$columns = array();
		    	$data = array();
		    	$i = 0;
		    	foreach($names as $k=>$d) {
		    		if($i >= $this->_start && $i < $this->_limit) {
		    			$data[$i]['TRAINING_NAME'] = $k;
		    			foreach($d as $_k => $_d) {
		    				$data[$i][$_k] = $_d;
		    			}
		    		}
		    		$i++;
		    	}
		    	
		    	$total = array();
		         foreach ($data as $key=>$row) {
		         	$col = array();
		         	foreach ($row as $x=>$y) {
					$col[] = array('text' => $y , 'width' => '23','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
					$total[] = $y;
		         	}
		         	$columns[] = $col;	
					}
					$pdf->WriteTable($columns);
					
				$acc = array_shift($data);
			    foreach ($data as $val) {
			       foreach ($val as $key => $val) {
			        $acc[$key] += $val;
			        }
                }
                
                $replace = array('TRAINING_NAME'=>'Total');
				$acc = array_replace($acc, $replace);
				$footerTable = array($acc);
				$columns = array();
				if ( $footerTable ) foreach( $footerTable as $split ):
				$array = array_values($split);
				$col = array();
				for ($i = 0; $i < count($array); ++$i) {
					$col[] = array('text' => $array[$i] , 'width' => '23','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				}
				$columns[] = $col;
				$pdf->WriteTable($columns);
				endforeach;

						


			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
			} catch(Exception $e) {
				$this->exception($e);
			}
		}


	public function getCountryAction() {
		try {

			$model = new countries_Model_Country();

			$q = $model->select()
			->from($model->getTableName(), array('NAME'))
			->distinct(true);

			$res = $q->query()->fetchAll();
			$this->_data['names'] = $res;

		} catch(Exception $e) {
			$this->exception($e);
		}
	}
}