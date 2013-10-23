<?php
require_once''.APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once''.APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';
class Participants_RequestController extends MyIndo_Controller_Action
{
	protected $_unique;
	protected $_modelView;
	protected $_modelDetail;
	protected $_modelTrtraining;
	protected $_modelTrainingView;
	protected $_msCountry;
	protected $_modelParticipants;
	protected $_required;
	protected $_sData;

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
        
		$this->_model = new participants_Model_Participants();
		$this->_modelTrtraining = new trtrainings_Model_TrTrainings();
		$this->_msCountry = new countries_Model_Country();
 		$this->_modelTrainingView = new trtrainings_Model_TrTrainingsView();
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
// 		$this->_modelTrainingView = new trtrainings_Model_TrTrainingsView();
		$this->_modelParticipants = new participants_Model_Participants();
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
	

    public function participantTrainingsAction()
	{
		try {
			//$list = array();
			if(isset($this->_posts['PARTICIPANTS_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['PARTICIPANTS_ID']);
//				print_r($id);
				if($this->_modelDetail->isExist('PARTICIPANT_ID', $id)) {
					$q = $this->_modelDetail->select()->where('PARTICIPANT_ID = ?', $id);
					$listtmp = $q->query()->fetchAll();
					if(count($listtmp) > 0) {
						$trainingIds = array();
						foreach($listtmp as $k => $v) {
							if(!in_array($v['TRAINING_ID'], $trainingIds)) {
								$trainingIds[] = $v['TRAINING_ID'];
							}
						}
					}
						
						$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('PARTICIPANT_ID = ?', $id);
						$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('TRAINING_ID IN (?)', $trainingIds);
				}
						$this->_data['items'] = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
						$this->_data['totalCount'] = $this->_modelDetail->count($this->_where);		
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

			$q = $this->_modelTrainingView->select()
			->from($this->_modelTrainingView->getTableName(), array('TRAINING_NAME','VENUE_COUNTRY_NAME'));

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
	
	public function printAction()
	{	
		
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 80;
		
		$pdf->SetFont('Arial','',12);
		$pdf->AliasNbPages();
		$pdf->AddPage();

			$filename ='ReportParticipant.' . date('Y-m-d-H-i-s');
			$pdf->Cell(10,10,'Report Participant',0,1,'');
			
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
			
			/* START Get Training ID Participants View */
			$select = $this->_modelParticipants->select()->distinct(true)->setIntegrityCheck(false)
			->from('TR_TRAINING_PARTICIPANTS_VIEW',array('TRAINING_ID', 'COUNT(*) as COUNT_PARTICIPANTS'))
			->group('TRAINING_ID');
			$result = $select->query()->fetchAll();
			/* END Get Training ID Participants View */
			
			$q = $this->_modelTrainingView->select()
			->from($this->_modelTrainingView->getTableName(), array('ID','TRAINING_NAME','VENUE_COUNTRY_NAME'));
			$res = $q->query()->fetchAll();
			
// 			$c = array();
			$arrayMap = array_map(null, $res, $result);
			foreach ($arrayMap as $key=>$val) {
				$arrayMerge = array_merge($val[0], $val[1]);
					$a[] = $arrayMerge['TRAINING_NAME'];
					$b[] = $arrayMerge['VENUE_COUNTRY_NAME'];
					$c[] = $arrayMerge['COUNT_PARTICIPANTS'];

				
// 			     foreach($countries as $_k => $_d) {
// 					if(!isset($names[$arrayMerge['TRAINING_NAME']][$arrayMerge['COUNT_PARTICIPANTS']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))])) {
// 						$names[$arrayMerge['TRAINING_NAME']][$arrayMerge['COUNT_PARTICIPANTS']]['TOTAL_' . str_replace(' ', '_', strtoupper($_d))] = 0;
// 					}
// 				}

// 				if(!isset($c[$arrayMerge['TRAINING_NAME']][$arrayMerge['VENUE_COUNTRY_NAME']])) {
// 					$c[$arrayMerge['TRAINING_NAME']][$arrayMerge['COUNT_PARTICIPANTS']][$arrayMerge['VENUE_COUNTRY_NAME']] = 1;
// 				} else {
// 					$c[$arrayMerge['TRAINING_NAME']][$arrayMerge['COUNT_PARTICIPANTS']][$arrayMerge['VENUE_COUNTRY_NAME']]++;
// 				}
			}
			$arrayLast = array_map(null, $a, $b, $c);
			print_r($arrayLast);

			
// 			$sum = array();
// 			foreach ($arrayLast as $key=>$val) {
// 				if ($key);
// 				 if (!isset($sum[$val[0]][$val[1]][$val[2]])) {
// 		             $sum[$val[0]][$val[1]][$val[2]] = 1;
// 				 } else {
// 				 	$sum[$val[0]][$val[1]][$val[2]]++;
// 				 }
// 			}
// 			print_r($sum);

// 			$totals = array();
// 			foreach($arrayLast as $val)
// 			{

// 				if (!isset($totals[$val[0]][$val[1]])) {
// 					$totals[$val[0]][$val[1]] += $val[2];
// 				} else {
// 					$totals[$val[0]][$val[1]] += $val[2];
// 				}
// 			}
// 			print_r($totals);
			
			print_r($sumResult);
			
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

			foreach ($data as $key=>$row) {
				$col = array();
				foreach ($row as $x=>$y) {
					$col[] = array('text' => $y , 'width' => '23','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				}
				$columns[] = $col;
			}
			$pdf->WriteTable($columns);
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		//}
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