<?php
class PostsController extends AppController {

  var $displayName = 'news';

  var $paginate = array(
    'limit' => 15
    );
    
  function index()
		{
		$this->Post->recursive = 0;
		$this->set('fields', $this->paginate());
		}
  
  function admin_index()
		{
		$this->Post->recursive = 0;
		$this->set('fields', $this->paginate());
		}

	function admin_add()
		{
		if (!empty($this->data))
			{
			$this->Post->create();
			if ($this->Post->save($this->data))
				{
				$this->Session->setFlash('Dodano '.$this->displayName, 'success');
        $this->redirect(array('action' => 'index'));
				}
			}
		$this->set('tags', $this->Post->Tag->find('list'));
		}

	function admin_edit($id = null)
		{
		$this->Post->id = $id;
    if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if (!empty($this->data))
			{
			if ($this->Post->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->Post->read(null, $id);
			}
		$this->set('tags', $this->Post->Tag->find('list'));
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if ($this->Post->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
			$this->redirect(array('action' => 'index'));
			}
		}

}
?>