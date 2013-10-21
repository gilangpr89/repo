<?php
require_once APPLICATION_PATH.'/../library_training/fpdf/myfpdf.php';

class Reports_PrintController extends MyIndo_Controller_Action
{
	protected $_modelDetail;
	protected $_model;
	protected $_modelParticipants;
	protected $_modelOrganizationUpload;

	public function init()
	{
		$this->_modelDetail = new trainingparticipants_Model_TrainingParticipantsView();
		$this->_modelOrganizationUpload = new organizations_Model_OrganizationsUploadView();
		$this->_modelParticipants = new participants_Model_Participants();
		$this->_model = new trtrainings_Model_TrTrainingsView();

	}
	
	public function individualAction()
	{
		$pdf = new myfpdf();
		$h = 13;
		$left = 40;
		$top = 60;
		
		
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage('p', 'a4');
		$pdf->Ln(2);
		
// 		$pdf->Cell(10,10,'Report Individual',0,1,'');
		$post = $this->getRequest()->getParams();
		$filename ='ReportIndividual.' . $this->_posts['ID'] . '.' . date('Y-m-d-H-i-s');
		
		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$this->_where[] = $this->_modelDetail->getAdapter()->quoteInto('ORGANIZATION_ID IN (?)', $id);
			$list = $this->_modelDetail->getList($this->_limit, $this->_start, $this->_order, $this->_where);
			
			$c = array();
			foreach ($list as $key=>$value) {
				
				if(!isset($c[$value['TRAINING_NAME']][$value['PARTICIPANT_NAME']])) {
					$c[$value['TRAINING_NAME']][$value['PARTICIPANT_NAME']] = 1;
				} else {
					$c[$value['TRAINING_NAME']][$value['PARTICIPANT_NAME']]++;
				}
			}
			
			$judulTable = array(
					array(
							'col1'	=> 'Organization Name : '.$post['NAME'],
					),
			);
			$columns = array();
			if ( $judulTable ) foreach( $judulTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'');
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
				
			$countryTable = array(
					array(
							'col2'	=> 'Country : '.$post['COUNTRY_NAME'],
					),
			);
			$columns = array();
			if ( $countryTable ) foreach( $countryTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col2'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'');
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
				
			$pdf->Ln(4);
			
			/* Start Label Table */
			$headerTable = array(
					array(
							'col1'	=> 'Training Name',
							'col2'	=> 'Participant Name',
					),
			);
			
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '65','height'=>'5', 'align' => 'L', 'font_name' => 'Times', 'font_size' => '10', 'font_style' => '', 'linearea'=>'LTBR');
			$col[] = array('text' => $split['col2'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);
			
			$columns = array();
			$temp='';
			foreach ($c as $key=>$value) {
				
				$col = array();
				$col[] = array('text' => ''.$key ,'width' => '65','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				foreach ($value as $k=>$v) {
					$temp = $temp.$k."\n";
				}
				
				$col[] = array('text' => $temp ,'width' => '65','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$columns[] = $col;
				$temp = '';
			}
			$pdf->WriteTable($columns);		
			
			
			
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
		$pdf->Ln(2);
		$filename ='ReportCbo.' . date('Y-m-d-H-i-s');
		$post = $this->getRequest()->getParams();

		if(isset($this->_posts['ID']) && !empty($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_modelOrganizationUpload->select()
			->from('MS_ORGANIZATIONS_UPLOAD_VIEW', array('ID'))
			->where('ORGANIZATION_ID IN (?)', $id);

			$q->query()->fetchAll();
			$list = $q->query()->fetchAll();
			$x = $this->_modelOrganizationUpload->select()
			          ->from('MS_ORGANIZATIONS_UPLOAD_VIEW', array('TRAINING_NAME','FILE_NAME'))
			          ->where('ID IN (?)', $list);
			$query = $x->query()->fetchAll();

			$judulTable = array(
					array(
							'col1'	=> 'Organization Name : '.$post['NAME'],
					),
			);
			$columns = array();
			if ( $judulTable ) foreach( $judulTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'');
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
			
			$countryTable = array(
					array(
							'col2'	=> 'Country : '.$post['COUNTRY_NAME'],
					),
			);
			$columns = array();
			if ( $countryTable ) foreach( $countryTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col2'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'');
			$columns[] = $col;
			$pdf->WriteTable($columns);
			endforeach;
			
			$pdf->Ln(4);
			
			$headerTable = array(
					array(
							'col1'	=> 'Training Name',
							'col2'	=> 'Doc Name',
					),
			);
			$columns = array();
			if ( $headerTable ) foreach( $headerTable as $split ):
			$col = array();
			$col[] = array('text' => $split['col1'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$col[] = array('text' => $split['col2'] , 'width' => '65','height'=>'5', 'align' => 'L','linearea'=>'LTBR');
			$columns[] = $col;
			endforeach;
			$pdf->WriteTable($columns);
			
			$c = array();
			foreach ($query as $k=>$value) {

				if(!isset($c[$value['TRAINING_NAME']][$value['FILE_NAME']])) {
					$c[$value['TRAINING_NAME']][$value['FILE_NAME']] = 1;
				} else {
					$c[$value['TRAINING_NAME']][$value['FILE_NAME']]++;
				}
			}

			$columns = array();
			$temp=''; // $temp penampung data loping sementara.
			foreach ($c as $key=>$value) {
				$col = array();
				$col[] = array('text' => ''.$key ,'width' => '65','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				foreach ($value as $k=>$v) {
					$temp = $temp.$k."\n";
				}
				$col[] = array('text' => ''.$temp ,'width' => '65','height'=>'5','align' => 'L','linearea'=>'LTBR',);
				$columns[] = $col;
				$temp='';
			}
			$pdf->WriteTable($columns);			

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
			$pdf->Output(PDF_PATH.'/public_html/pdf/participants/'.$filename.'.pdf','F');
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