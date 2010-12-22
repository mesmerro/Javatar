<?php
class PermissionsController extends AppController {

  var $displayName = 'uprawnienie';
  
  var $paginate = array(
    'limit' => 15
    );
    
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
				$this->Session->setFlash('Dodano '.$this->displayName, 'success');
        $this->redirect(array('action' => 'index'));
				}
			}
		}

	function admin_edit($id = null)
		{
		$this->Permission->id = $id;
    if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if (!empty($this->data))
			{
			if ($this->Permission->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->Permission->read(null, $id);
			}
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if ($this->Permission->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
			$this->redirect(array('action' => 'index'));
			}
		}

}
?>