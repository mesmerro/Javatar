<?php
class UsersController extends AppController {		
		
	var $uses = array('User', 'Permission');
  
  var $components = array('Email');
  
  var $userTypes = array(
		0 => 'Inactive',
		1 => 'User',
		2 => 'Editor',
		3 => 'Admin'
		);
    
  var $paginate = array(
    'limit' => 20
    );
    
  function activate($code = null)
    {
    if (!empty($code))
      {
      if ($user = $this->User->findByActivationCode($code))
        {
        $this->User->set(array(
          'activation_code' => null,
          'type' => 1
          ));
        $this->User->id = $user['User']['id'];
        if ($this->User->save($this->data))
				  {
				  $this->Session->setFlash('Aktywowano konto, możesz się teraz zalogować.', 'default', array('class' => 'success'));
          $this->redirect(array('controller' => 'posts', 'action' => 'index'));
				  }
        } else {
        $this->Session->setFlash('Niestety nie znaleziono konta dla tego kodu aktywacyjnego!', 'default', array('class' => 'failure'));
		    $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
      } else {
      $this->redirect(array('controller' => 'posts', 'action' => 'index'));
			}
    }
    
  function lost_password()
    {
    if ($this->Auth->user())
		  {
		  $this->redirect(array('controller' => 'posts', 'action' => 'index'));
      } else {
      if (!empty($this->data))
        {
        if ($user = $this->User->findByEmail($this->data['User']['email']))
          {
          $this->User->id = $user['User']['id'];
          $generated_password = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 8);
          $this->User->set(array(
            'password' => $this->Auth->password($generated_password)
            ));
          if ($this->User->save($this->data))
            {
            $this->Email->from = 'JavatarTeam <javatar@lfc.pl>';
            $this->Email->to = $user['User']['username'].' <'.$user['User']['email'].'>';
            $this->Email->subject = 'Przywracanie hasła [JavatarBlog]';
            $this->Email->template = 'lost_password';
            $this->Email->sendAs = 'both';
            $this->set('generated_password', $generated_password);
            $this->Email->send();
            $this->Email->reset();
            
				    $this->Session->setFlash('W ciągu kilku minut powinnien dojść mail z wygenerowanym nowym hasłem.', 'default', array('class' => 'success'));
				    $this->redirect(array('controller' => 'posts', 'action' => 'index'));
				    }
          echo 1;
          } else {
          $this->Session->setFlash('Niestety, nie znaleziono konta użytkownika z podanym adresem email.', 'default', array('class' => 'failure'));
		      $this->redirect(array('controller' => 'posts', 'action' => 'index'));
          }
        }
      }
    }

	function register()
		{    
    if ($this->Auth->user())
		  {
		  $this->set('notice', 'Jesteś zalogowany, dlaczego więc chcesz się rejestrować?');
      } else {
      if (!empty($this->data))
        {
        $this->User->create();
        $activation_code = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 16);
        $this->User->set(array(
          'email' => $this->data['User']['register_email'],
          'username' => $this->data['User']['register_username'],
          'avatar' => $this->data['User']['register_avatar'],
          'password' => $this->Auth->password($this->data['User']['register_password']),
          'activation_code' => $activation_code
          ));
        if ($this->User->save($this->data))
          {
          $this->Email->from = 'JavatarTeam <javatar@lfc.pl>';
          $this->Email->to = $this->data['User']['register_username'].' <'.$this->data['User']['register_email'].'>';
          $this->Email->subject = 'Rejestracja [JavatarBlog]';
          $this->Email->template = 'register';
          $this->Email->sendAs = 'both';
          $this->set('activation_code', $activation_code);
          $this->Email->send();
          $this->Email->reset();
          
          $this->Session->setFlash('Zapisano, w ciągu kilku minut powinnien dojść mail z linkiem aktywacyjnym, dziekujemy!', 'default', array('class' => 'success'));
				  $this->redirect(array('controller' => 'posts', 'action' => 'index'));
				  }
        }
      }
		}
  
  function login()
		{
		$this->redirect($this->referer());
    }
		
	function logout()
		{
    $this->Session->delete('Permissions');
		$this->redirect($this->Auth->logout());
		}
  
  ######################################################################################################
  
  function admin_index()
		{
		$this->User->recursive = 0;
		$this->set('fields', $this->paginate());
		}
    
  function admin_add()
		{
		if (!empty($this->data))
			{
			$this->User->create();
			if ($this->User->save($this->data))
				{
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
				}
			}
		$this->set('userTypes', $this->userTypes);
    }
		
	function admin_edit($id = null)
    {
    $this->User->id = $id;
    if (empty($this->data))
      {
		  $this->data = $this->User->read();
      } else {
		  if (!empty($this->data['User']['new_password']))
        {
        $this->User->set(array(
          'password' => Security::hash($this->data['User']['new_password'], 'sha1', true)
          ));
        }
			if ($this->User->save($this->data))
        {
        $this->Session->setFlash('Edytowano.', 'default', array('class' => 'success'));
        $this->redirect(array('action' => 'index'));
		    }
      }
    $this->set('userTypes', $this->userTypes);
		}

	function admin_delete($id = null)
    {
    if ($this->User->delete($id))
      {
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect(array('action' => 'index'));
      }
    }
		
	function admin_permissions($user_id = null)
    {
    $this->User->unbindModel(array('hasMany' => array('Post', 'Comment')));
    if (!$user_id)
      {
      $data = $this->Permission->User->find('all');
      foreach($data AS $field)
        {
        foreach($field['Permission'] AS $permission)
          {
          $fields[] = array('User' => $field['User'], 'Permission' => $permission);
          }
        }
      $this->set('notice', 'Wyświetlenie uprawnień wszystkich użytkowników');
      } else {
      $data = $this->Permission->User->find('all', array('conditions' => array('User.id' => $user_id)));
      foreach($data AS $field)
        {
        foreach($field['Permission'] AS $permission)
          {
          $fields[] = array('User' => $field['User'], 'Permission' => $permission);
          }
        }
      $this->set('notice', 'Wyświetlenie uprawnień dla użytkownika '.$fields[0]['User']['username']);
      }
    $this->set('fields', $fields);
    }
    
  function admin_add_permission()
		{
		if (!empty($this->data))
			{
			if ($this->User->habtmAdd('Permission', $this->data['PermissionUser']['user'], $this->data['PermissionUser']['permission']))
				{
				$this->Session->setFlash('Dodano.', 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'permissions', $this->data['PermissionUser']['user']));
				}
			}
		$this->set('users', $this->User->find('list', array('conditions' => array('User.type >=' => '2'))));
    $this->set('permissions', $this->Permission->find('list'));
    }
    
  function admin_delete_permission($user_id = null, $permission_id = null)
		{
		if ($this->User->habtmDelete('Permission', $user_id, $permission_id))
			{
		  $this->Session->setFlash('Usunięto.', 'default', array('class' => 'success'));
		  $this->redirect($this->referer());
      }
		}
	
	function admin_login()
		{
		}
 
	function admin_logout()
		{
    $this->Session->setFlash('Do zobaczenia!');
    $this->Session->delete('Permissions');
		$this->redirect($this->Auth->logout());
		}

}
