<?php

class Trtrainingmodules_RequestController extends MyIndo_Controller_Action
{	
	protected $_upload_path;
	protected $_allowed_file_extension;
	protected $_modelTraining;
	protected $_max_file_size;

	public function init()
	{
		$this->_model = new trtrainingmodules_Model_TrainingModules();
		$this->_upload_path = APPLICATION_PATH . '/../public_html/uploads/modules/';
		$this->_allowed_file_extension = array('ppt','doc','docx','xls','xlsx','pdf');
		$this->_modelTraining = new trtrainings_Model_TrTrainings();
		$this->_max_file_size = 10 * 1024 * 1024;
	}

	public function readAction()
	{
		if(isset($this->_posts['TRAINING_ID'])) {
			$trainingId = $this->_enc->base64decrypt($this->_posts['TRAINING_ID']);
			$q = $this->_modelTraining->select()->where('ID = ?', $trainingId);
			if($q->query()->rowCount() > 0) {
				$this->_where[] = $this->_model->getAdapter()->quoteInto('TRAINING_ID = ?', $trainingId);

				$this->_data['items'] = $this->_model->getList($this->_limit, $this->_start, $this->_order, $this->_where);
				$this->_data['totalCount'] = $this->_model->count($this->_where);
			} else {
				$this->error(101, 'Invalid training.');
			}
		} else {
			$this->error(901);
		}
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
				if($fileInfo['FILE']['size'] <= $this->_max_file_size) {
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

	public function deleteAction()
	{
		if(isset($this->_posts['ID'])) {
			$id = $this->_enc->base64decrypt($this->_posts['ID']);
			$q = $this->_model->select()->where('ID = ?', $id);
			if($q->query()->rowCount() > 0) {
				$detail = $q->query()->fetch();
				try {
					/* Delete File */
					if(file_exists(APPLICATION_PATH . '/../public_html/' . $detail['FILE_PATH'])) {
						unlink(APPLICATION_PATH . '/../public_html/' . $detail['FILE_PATH']);
					}
					$this->_model->delete($this->_model->getAdapter()->quoteInto('ID = ?', $id));
				} catch(Exception $e) {
					$this->exception($e);
				}
			} else {
				$this->error(101, 'Invalid Module.');
			}
		} else {
			$this->error(901);
		}
	}
}