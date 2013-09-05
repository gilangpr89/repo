<?php
require_once APPLICATION_PATH.'/../library_training/fpdf/fpdf.php';
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Reports_PrintController extends MyIndo_Controller_Action
{
	protected $_modelDetail;
	protected $_model;
	protected $_modelParticipants;

	public function init()
	{
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_modelParticipants = new participants_Model_Participants();
		$this->_model = new trtrainings_Model_TrTrainingsView();
	}
	
	public function individualAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 80;
		
		$pdf->SetFont('Times','',14);
		$pdf->AliasNbPages();
		
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
		    $q = $this->_modelDetail->select()->from('TR_TRAINING_PARTICIPANTS_VIEW',array('*'))
		    ->where('PARTICIPANT_ID = ?', $id);
		    $listParticipant = $q->query()->fetchAll();
			foreach ($listParticipant as $ids) {
				$Tid = $ids['TRAINING_ID'];
			}
			$q = $this->_model->select()
			->setIntegrityCheck(false)
			->from('TR_TRAININGS_VIEW',array('*'))
			->where('TRAINING_ID IN (?)', $Tid);
		
			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
			}
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			
			$pdf->Cell(10,10,'Report Individual',0,1,'');
			$filename ='ReportIndividual.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
			
			foreach ($listParticipant as $val) {
				$pdf->AddPage();
				$pdf->Cell(10,10,'Report Individual',0,1,'');
				$columns = array();
				$col = array();
				$col[] = array('text' => 'First Name : '.$val['PARTICIPANT_FNAME'] ,'width' => '95','height'=>'5','align' => 'L', 'font_name' => 'Times', 'font_size' => '12', 'font_style' => '', 'linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Middle Name : '.$val['PARTICIPANT_MNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Last Name : '.$val['PARTICIPANT_LNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Surname : '.$val['PARTICIPANT_SNAME'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Gender : '.$val['PARTICIPANT_GENDER'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Brith Date : '.$val['PARTICIPANT_BDATE'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Mobile Number : '.$val['PARTICIPANT_MOBILE_NO'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);

				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Phone Number : '.$val['PARTCIPANT_PHONE_NO'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'First Email : '.$val['PARTICIPANT_EMAIL1'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Second Email : '.$val['PARTICIPANT_EMAIL2'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
					
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Facebook : '.$val['PARTICIPANT_FB'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
				 
				$columns = array();
				$col = array();
				$col[] = array ('text' => 'Twitter : '.$val['PARTICIPANT_TWITTER'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			//}
			/* Start Label Table */
			$pdf->Ln('10');
			$headerTable = array(
					array(
							'col1'	=> 'Training Name',
							'col2'	=> 'Beneficiaries Name',
// 							'col3'	=> 'Organization Province',
// 							'col4'  => 'Organization Country',
							'col5'  => 'Organization',
							'col6'  => 'Position',
							'col7'  => 'Pre Test',
							'col8'  => 'Post Test',
// 							'col9'  => 'Diff',
							'col10' => 'Start Date',
							'col11' => 'End Date',
					),
			);
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '35','height'=>'5', 'align' => 'L', 'font_name' => 'Times', 'font_size' => '10', 'font_style' => '', 'linearea'=>'LTBR');
			$col[] = array('text' => $split['col2'] , 'width' => '27','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col3'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col4'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
 			$col[] = array('text' => $split['col5'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col6'] , 'width' => '18','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col7'] , 'width' => '15','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col8'] , 'width' => '15','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
// 			$col[] = array('text' => $split['col9'] , 'width' => '10','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col10'] , 'width' => '20','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col11'] , 'width' => '20','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);
			
			foreach ($list as $row) {
				
		    $columns = array();
	        $col = array();
		    $col[] = array('text' => '' .$row['TRAINING_NAME'],'width' => '35','height'=>'5', 'align' => 'L','linearea' => 'LTBR',);
	        $col[] = array('text' => '' .$row['BENEFICIARIES_NAME'] ,'width' => '27','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => '' .$row['ORGANIZATION_PROVINCE_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => '' .$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['ORGANIZATION_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_PHONE_NO1'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_PHONE_NO2'] ,'width' => '95','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_EMAIL1'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_EMAIL2'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_WEBSITE'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'',);
// 	        $col[] = array('text' => ''.$row['ORGANIZATION_ADDRESS'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'',);
	        $col[] = array('text' => '' .$val['POSITION_NAME'] ,'width' => '18','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$val['PRE_TEST'] ,'width' => '15','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$val['POST_TEST'] ,'width' => '15','height'=>'5','align' => 'L','linearea'=>'LTBR',);
// 	        $col[] = array('text' => '' .$val['DIFF'] ,'width' => '10','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['SDATE'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $col[] = array('text' => '' .$row['EDATE'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'LTBR',);
	        $columns[] = $col;
	        $pdf->WriteTable($columns);
	        
			}
		}
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	public function cboAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
		
		
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage('p', 'a4');
		$pdf->Ln(10);
		$pdf->Cell(10,10,'Report CBO',0,1,'');
		$filename ='ReportCbo.' . date('Y-m-d-H-i-s');
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_model->select()
			->from('TR_TRAININGS_VIEW', array('ID'))
			->where('ORGANIZATION_ID IN (?)', $id);
			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
			}
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('*'))->where('ID IN (?)', $list);
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
			$col[] = array('text' => $split['col3'] , 'width' => '25','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
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
						$col[] = array('text' => ''.$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '25','height'=>'5','align' => 'L','linearea'=>'LTBR',);
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
	
	public function srcountryAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
	
	
		$pdf->SetFont('Times','',12);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelDetail->select()
			->setIntegrityCheck(false)
			->from('TR_TRAININGS_VIEW',array('ID'))
			->where('ORGANIZATION_COUNTRY_ID = ?', $id);

			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
			}
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('*'))
			->where('ID IN (?)', $list);
			$query = $x->query()->fetchAll();
			
			$filename ='ReportSrCountry.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
			$pdf->Cell(10,10,'Report SrCountry',0,1,'');
			
// 			if (isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
// 				$start_date = explode('T',$this->_posts['START_DATE']);
// 				$pdf->Cell(78,9,'Periode : ' . $start_date[0] .'','',1,'L');
// 			}else {
// 			   $pdf->Cell(78,9,'Periode : All Data' . $start_date[0] .'','',1,'L');
// 			}
				
			$pdf->Ln('10');
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
			$col[] = array('text' => $split['col1'] , 'width' => '40','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col2'] , 'width' => '30','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col3'] , 'width' => '30','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col4'] , 'width' => '24','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col5'] , 'width' => '25','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col6'] , 'width' => '21','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col7'] , 'width' => '21','height'=>'7', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);

					foreach ($query as $row) {
						
						$columns = array();
						$col = array();
						$col[] = array('text' => ''.$row['TRAINING_NAME'],'width' => '40','height' => '5','align' => 'L','linearea' => 'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_PROVINCE_NAME'] ,'width' => '24','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_CITY_NAME'] ,'width' => '25','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['SDATE'] ,'width' => '21','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['EDATE'] ,'width' => '21','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$columns[] = $col;
						$pdf->WriteTable($columns);		
					}
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}

	public function regionAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
	
		$pdf->SetFont('Arial','',12);
		$pdf->AddPage();
		$pdf->Ln('10');
		
		$pdf->Cell(10,10,'Report Region',0,1,'');
		$filename ='ReportRegion.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_model->select()
			->setIntegrityCheck(false)
			->from('TR_TRAININGS_VIEW', array('ID'))
			->where('AREA_LEVEL_ID  IN (?)', $id);
			
			if(isset($this->_posts['START_DATE']) && isset($this->_posts['END_DATE']) && !empty($this->_posts['START_DATE']) && !empty($this->_posts['END_DATE'])) {
				$q->where('SDATE >= ?', $this->_posts['START_DATE']);
				$q->where('SDATE <= ?', $this->_posts['END_DATE']);
			}
			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
	        $x = $this->_model->select()->from('TR_TRAININGS_VIEW', array('*'))->where('ID IN (?)', $list);
	        $query = $x->query()->fetchAll();

	        $headerTable = array(
								array(
									'col1'	=> 'Training Name',
									'col2'	=> 'Area Level',
									'col3'	=> 'Funding Source',
									'col4'  => 'Organization',
									'col5'  => 'Country',
									'col6'  => 'Start Date',
									'col7'  => 'End Date',
								),
							);
			$columns = array();  
			if ( $headerTable ) foreach( $headerTable as $split ):
				$col = array();
	    		$col[] = array('text' => $split['col1'] , 'width' => '33','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		$col[] = array('text' => $split['col2'] , 'width' => '20','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		//$col[] = array('text' => $split['col3'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		$col[] = array('text' => $split['col4'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		$col[] = array('text' => $split['col5'] , 'width' => '30','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		$col[] = array('text' => $split['col6'] , 'width' => '22','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
	    		$col[] = array('text' => $split['col7'] , 'width' => '22','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);
			
			foreach ($query as $row){

						$columns = array();
						$col = array();
						$col[] = array('text' => ''. $row['TRAINING_NAME'] . '','width' => '33','height' => '5','align' => 'L','linearea' => 'LTBR',);
						$col[] = array('text' => ''.$row['AREA_LEVEL_NAME'],'width' => '20','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						//$col[] = array('text' => ''.$row['FUNDING_SOURCE_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['ORGANIZATION_COUNTRY_NAME'] ,'width' => '30','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['SDATE'] ,'width' => '22','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$col[] = array('text' => ''.$row['EDATE'] ,'width' => '22','height'=>'5','align' => 'L','linearea'=>'LTBR',);
						$columns[] = $col;
 					    $pdf->WriteTable($columns);
					}
			//$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
		}
	}
	
	public function trainingPrintAction()
	{
		try {
			$pdf = new myfpdf();
			$h = 13;
			$left = 40;
			$top = 60;
			
			
			$pdf->SetFont('Arial','',12);
			$pdf->AddPage();
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(10,10,'Report Training Evaluation',0,1,'');
			$pdf->Ln(2);

			$filename ='ReportTrainingEvaluation.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
			
			/**
			 * Start Query Parse Data To Pdf
			 */
			if(isset($this->_posts['TRAINING_ID']) && !empty($this->_posts['TRAINING_ID'])) {
				$id = $this->_enc->base64decrypt($this->_posts['TRAINING_ID']);
				$q = $this->_modelDetail->select()->from('TR_TRAINING_PARTICIPANTS_VIEW', array('*'))->where('TRAINING_ID = ?', $id);
				$q->query()->fetchAll();
				$list = $q->query()->fetchAll();
			
			/* Start Label Table */
				$headerTable = array(
						array(
								'col1'	=> 'Training Name',
								'col2'	=> 'Participant Name',
								'col3'	=> 'Organization',
								'col4'  => 'Pre Test',
								'col5'  => 'Post Test',
								'col6'  => 'Diff',
						),
				);
				$columns = array();
				if ( $headerTable ) foreach( $headerTable as $split ):
				$col = array();
				$col[] = array('text' => $split['col1'] , 'width' => '33','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$col[] = array('text' => $split['col2'] , 'width' => '40','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$col[] = array('text' => $split['col3'] , 'width' => '35','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$col[] = array('text' => $split['col4'] , 'width' => '20','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$col[] = array('text' => $split['col5'] , 'width' => '20','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$col[] = array('text' => $split['col6'] , 'width' => '12','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
				$columns[] = $col;
				endforeach;
				$pdf->WriteTable($columns);
				
			foreach ($list as $row) {
				$columns = array();
				$col = array();
				$col[] = array('text' => '' .$row['PARTICIPANT_NAME'],'width' => '33','height'=>'5', 'align' => 'L','linearea' => 'LTBR',);
				$col[] = array('text' => '' .$row['TRAINING_NAME'],'width' => '40','height'=>'5', 'align' => 'L','linearea' => 'LTBR',);
				$col[] = array('text' => '' .$row['ORGANIZATION_NAME'] ,'width' => '35','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$col[] = array('text' => '' .$row['PRE_TEST'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$col[] = array('text' => '' .$row['POST_TEST'] ,'width' => '20','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$col[] = array('text' => '' .$row['DIFF'] ,'width' => '12','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$columns[] = $col;
				$pdf->WriteTable($columns);
			}
			if(!is_dir($filename))
				@mkdir($filename,0755,true);
			
			$pdf->Output('pdf/participants/' . $filename . '.pdf','F');
			
			$this->_data['fileName'] = $filename . '.pdf';
			$this->_data['path'] = 'pdf/participants/';
			}
		} catch (Exception $e) {
			$this->exception($e);
		}
	}
}