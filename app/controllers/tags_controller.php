<?php
class TagsController extends AppController {
	
	var $displayName = 'tag';
  
  var $paginate = array(
        'limit' => 15
    );
    
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
				$this->Session->setFlash('Dodano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		}

	function admin_edit($id = null)
		{
		if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if (!empty($this->data))
			{
			if ($this->Tag->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->Tag->read(null, $id);
			}
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if ($this->Tag->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
			$this->redirect(array('action' => 'index'));
			}
		}

}
?>