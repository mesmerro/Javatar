<?php
class UploadsController extends AppController {
	
	var $components = array('File');
	
	var $paginate = array(
    'limit' => 20
    );
    
  function admin_index()
		{
		$this->File->recursive = 0;
		$this->set('fields', $this->paginate());
		}
    
  function admin_add()
		{
		if (!empty($this->data))
			{
			$filename = substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm1234567890"), 0, 8).'-'.$this->data['Upload']['file']['name'];
			// pr($this->data);
			$upload = array(
        'Upload' => array(
          'path' => '/uploads/'.date("Y").'/'.date("m").'/'.$filename,
          'filename' => $filename
          )
        );
			if ($this->Upload->save($upload) AND $this->File->upload($this->data, $filename))
				{
				$this->Session->setFlash('Wgrano plik.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		}
		
	function admin_delete($id = null)
    {
    $upload = $this->Upload->findById($id);
    if ($this->Upload->delete($id) AND $this->File->delete($upload['Upload']['path']))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      echo 1;
      }
    }

}
?>