<?php
class PagesController extends AppController {

  var $paginate = array(
    'limit' => 20
    );
  
  function show($page = null)
		{
		$page = $this->Page->findByNiceUrl($page);    
    $this->set('field', $this->Page->find('first', array('conditions' => array('Page.id' => $page['Page']['id']))));
		}
    
  ######################################################################################################
  
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
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		}
    
  function admin_edit($id = null)
    {
    $this->Page->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->Page->read();
      } else {
		  if ($this->Page->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
		    }
      }
    }
    
  function admin_delete($id = null)
    {
    if ($this->Page->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      }
    }

}
?>