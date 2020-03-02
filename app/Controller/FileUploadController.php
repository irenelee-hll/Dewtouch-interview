<?php
use Cake\Utility\Security;
class FileUploadController extends AppController {

	public function initialize(){
		parent::initialize();
		$this->Auth->allow(['index', 'upload', 'download', 'delete']);
	}

	public function index() {
		$this->set('title', __('File Upload Answer'));

		// $file_uploads = $this->FileUpload->find('all');
		// $this->set(compact('file_uploads'));
		
		$uploadData = '';
		if ($this->request->is('post')) {
				if(!empty($this->request->data['file']['name'])){
						$fileName = $this->request->data['file']['name'];
						$uploadPath = 'uploads/files/';
						$uploadFile = $uploadPath.$fileName;
						if(move_uploaded_file($this->request->data['file']['tmp_name'],	$uploadFile)){
								$uploadData = $this->Files->newEntity();
								$uploadData->name = $fileName;
								$uploadData->path = $uploadPath;
								$uploadData->created = date("Y-m-d H:i:s");
								$uploadData->modified = date("Y-m-d H:i:s");
								if ($this->Files->save($uploadData)) {
										$this->Flash->success(__('File has been uploaded and inserted successfully.'));
								}else{
										$this->Flash->error(__('Unable to upload file, please try again.'));
								}
						}else{
								$this->Flash->error(__('Unable to upload file, please try again.'));
						}
				}else{
						$this->Flash->error(__('Please choose a file to upload.'));
				}
						
				}
				$this->set('uploadData', $uploadData);
				
				$files = $this->Files->find('all');
				$filesRowNum = $files->count();
				$this->set('files',$files);
				$this->set('filesRowNum',$filesRowNum);
		}
	}