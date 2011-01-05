<?php
class ProfileController extends AppController {		
		
	var $uses = array('User', 'Permission');
	
	function beforeFilter()
    {
    if (!$this->Auth->user())
		  {
		  $this->redirect(array('controller' => 'posts', 'action' => 'index'));
      }
    }
  
  function index()
    {
    }
    
  function avatar()
    {
    $this->User->id = $this->Session->read('Auth.User.id');
    if (empty($this->data))
      {
      $this->data = $this->User->read();
      } else {
      if ($this->User->save($this->data))
        {
        $this->Session->setFlash('Edytowano avatar.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
        }
      }
    }
  
  function email()
    {
    $this->User->id = $this->Session->read('Auth.User.id');
    if (empty($this->data))
      {
      $this->data = $this->User->read();
      } else {
      if ($this->User->save($this->data))
        {
        $this->Session->setFlash('Edytowano adres email.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
        }
      }
    }
    
  function password()
    {
    $this->User->id = $this->Session->read('Auth.User.id');
    if (empty($this->data))
      {
      $this->data = $this->User->read();
      } else {
      $this->User->set(array(
        'password' => $this->Auth->password($this->data['User']['profile_password'])
        ));
      if ($this->User->save($this->data))
        {
        $this->Session->setFlash('Edytowano hasło.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
        }
      }
    }
	
}
