<?php

class Trtrainingmodules_RequestController extends MyIndo_Controller_Action
{	
	protected $_upload_path;
	protected $_allowed_file_extension;
	protected $_modelTraining;

	public function init()
	{
		$this->_model = new trtrainingmodules_Model_TrainingModules();
		$this->_upload_path = APPLICATION_PATH . '/../public_html/uploads/modules/';
		$this->_allowed_file_extension = array('ppt','doc','docx','xls','xlsx');
		$this->_modelTraining = new trtrainings_Model_TrTrainings();
	}
	public function createAction()
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

				$trainingId = $this->_enc->base64decrypt($this->_posts['TRAINING_ID']);

				/* Check for exist training */
				$q = $this->_modelTraining->select()->where('ID = ?', $trainingId);
				if($q->query()->rowCount() > 0) {

					try {
						$rename = $this->_posts['FILE_NAME'] . '_' . date('Y_m_d_H_i_s') . '.' . $fileExtension;
						$upload->addFilter('Rename', $this->_upload_path . $rename);
						$upload->receive();
						// echo $this->_upload_path . $this->_posts['FILE_NAME'] . '_' . date('Y_m_d_H_i_s') . '.' . $fileExtension;
						// //$upload->addFilter('Rename', APPLICATION_PATH.'/../public/images/avatars/'.$userId.'.jpg');
						$this->_model->insert(array(
							'TRAINING_ID' => $trainingId,
							'FILE_NAME'	=> $this->_posts['FILE_NAME'],
							'FILE_SIZE' => $fileInfo['FILE']['size'],
							'FILE_MIME_TYPE' => $fileInfo['FILE']['type'],
							'FILE_PATH' => 'uploads/modules/' . $rename,
							'CREATED_DATE' => $this->_date
							));
					} catch(Exception $e) {
						$this->exception($e);
					}

				} else {
					$this->error(101, 'Invalid training.');
				}

			} else {
				$this->error(1021, 'Not allowed file extension \'' . $fileExtension . '\'.');
			}

			$this->json();die;
		} catch(Zend_File_Transfer_Exception $e) {
			$this->exception($e);
		}
	}
}