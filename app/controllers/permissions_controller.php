<?php
class PermissionsController extends AppController {
  
  var $paginate = array(
    'limit' => 20
    );
    
  ######################################################################################################
    
  function admin_index()
		{
    $this->set('fields', $this->paginate());
    }

	function admin_add()
		{
		if (!empty($this->data))
			{
			$this->Permission->create();
			if ($this->Permission->save($this->data))
				{
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		}
		
	function admin_edit($id = null)
    {
    $this->Permission->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->Permission->read();
      } else {
		  if ($this->Permission->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
		    }
      }
    }
    
  function admin_delete($id = null)
    {
    if ($this->Permission->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      }
    }

}
?>