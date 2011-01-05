<?php
class CommentsController extends AppController {

  var $paginate = array(
    'limit' => 20
    );
    
  function add()
    {
    if (!empty($this->data))
			{
			$this->data['Comment']['user_id'] = $this->Auth->user('id');
			$this->Comment->create();
			if ($this->Comment->save($this->data))
				{
				$this->redirect($this->referer());
        }
			}
    }  
  
  ######################################################################################################
  
  function admin_index($post_id = null)
		{
		$this->Comment->recursive = 0;
		$this->set('fields', $this->paginate('Comment', array('Comment.post_id' => $post_id)));
		}
		
	function admin_edit($id = null)
    {
    $this->Comment->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->Comment->read();
      } else {
		  if ($this->Comment->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index', $this->data['Comment']['post_id']));
		    }
      }
    }
		
	function admin_delete($id = null)
    {
    $comment = $this->Comment->findById($id);
    if ($this->Comment->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index', $comment['Comment']['post_id']));
      }
    }

}
?>