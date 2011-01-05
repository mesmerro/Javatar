<?php
class TagsController extends AppController {
  
  var $paginate = array(
        'limit' => 20
    );
    
  ######################################################################################################
	
  function admin_index()
		{
		$this->Tag->recursive = 0;
		$this->set('fields', $this->paginate());
		}

	function admin_add()
		{
		if (!empty($this->data))
			{
			$this->Tag->create();
			if ($this->Tag->save($this->data))
				{
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		}
    
  function admin_edit($id = null)
    {
    $this->Tag->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->Tag->read();
      } else {
		  if ($this->Tag->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
		    }
      }
    }
    
  function admin_delete($id = null)
    {
    if ($this->Tag->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      }
    }

}
?>