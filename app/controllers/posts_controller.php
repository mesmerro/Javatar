<?php
class PostsController extends AppController {

  var $uses = array('Post', 'PostsTag', 'Tag');
  
  var $helpers = array('Date');

  var $paginate = array(
    'limit' => 20
    );
    
  function archive()
		{
		if (empty($this->data))
      {
      // szukanie
      $this->render('archive_searchform');
		  } else {
		  $this->paginate = array(
        'conditions' => array('Post.body LIKE' => '%'.$this->data['Post']['search'].'%'),
        'limit' => 10
        );
      $this->set('fields', $this->paginate());
		  }
		}
    
  function index()
		{
		$this->set('fields', $this->Post->find('all', array('limit' => 10)));
		}
		
	function show($id = null)
		{
		$this->set('field', $this->Post->getPostWithComments($id));
		}
    
  function tag($tag = null)
		{
		$tag = $this->Tag->findByName($tag);
    $this->Post->bindModel(array('hasOne' => array('PostsTag')), false);
    $this->paginate = array(
      'conditions' => array('PostsTag.tag_id' => $tag['Tag']['id']),
      'limit' => 10
      );    
    $this->set('fields', $this->paginate());
		}	
		
	######################################################################################################
		
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
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		$this->set('tags', $this->Post->Tag->find('list'));
    }
    
  function admin_edit($id = null)
    {
    $this->Post->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->Post->read();
      } else {
		  if ($this->Post->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
		    }
      }
    $this->set('tags', $this->Post->Tag->find('list'));
    }
    
  function admin_delete($id = null)
    {
    if ($this->Post->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      }
    }

}
?>