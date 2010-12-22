<?php
class CommentsController extends AppController {

  var $displayName = 'komentarz';
  
  var $paginate = array(
    'limit' => 15
    );
    
  function admin_index($post_id)
		{
		$this->Comment->recursive = 0;
		$this->set('fields', $this->paginate('Comment', array('Comment.post_id' => $post_id)));
		}

	function admin_edit($id = null)
		{
		if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'list'));
			}
		if (!empty($this->data))
			{
			if ($this->Comment->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'list', 'id' => $this->data['Comment']['post_id']));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->Comment->read(null, $id);
			}
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'list'));
			}
		if ($this->Comment->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
			$this->redirect(array('action' => 'list'));
			}
		}

}
?>