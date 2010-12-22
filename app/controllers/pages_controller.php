<?php
class PagesController extends AppController {

  var $displayName = 'strona';

  var $paginate = array(
    'limit' => 30
    );
  
  function admin_index()
		{
		$this->Page->recursive = 0;
		$this->set('fields', $this->paginate());
		}

	function admin_add()
		{
		if (!empty($this->data))
			{
			$this->Page->create();
			if ($this->Page->save($this->data))
				{
				$this->Session->setFlash('Dodano '.$this->displayName, 'success');
        $this->redirect(array('action' => 'index'));
				}
			}
		}

	function admin_edit($id = null)
		{
		$this->Page->id = $id;
    if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowa '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if (!empty($this->data))
			{
			if ($this->Page->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->Page->read(null, $id);
			}
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowa '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if ($this->Page->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
			$this->redirect(array('action' => 'index'));
			}
		}

}
?>