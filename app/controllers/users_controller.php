<?php
class UsersController extends AppController {

  var $uses = array('User', 'Permission');
  
  var $userTypes = array(
		0 => 'Inactive',
		1 => 'User',
		2 => 'Editor',
		3 => 'Admin'
		);
    
  var $paginate = array(
    'limit' => 30
    );
    
  function register()
		{
		if ($this->Auth->user())
		  {
		  $this->set('notice', 'Jesteś zalogowany, dlaczego więc chcesz się rejestrować?');
      } else {
      if (!empty($this->data))
        {
        $this->User->create();
        if ($this->User->save($this->data))
          {
				  $this->Session->setFlash('Zapisano, w ciągu kilku minut powinnien dojść mail z linkiem aktywacyjnym, dziekujemy!', 'success');
				  $this->redirect(array('action' => 'register'));
				  }
        }
      }
		}
    
  function login()
		{
		$this->redirect($this->Auth->redirect($this->referer()));
		}
		
	function logout()
		{
    $this->Session->delete('Permissions');
		$this->redirect($this->Auth->logout());
		}
		
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
				$this->Session->setFlash('Dodano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		$this->set('userTypes', $this->userTypes);
    }

	function admin_edit($id = null)
		{
		$this->User->id = $id;
    if (!$id && empty($this->data))
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if (!empty($this->data))
			{
			if (!empty($this->data['User']['newPassword'])) { $this->data['User']['password'] = Security::hash($this->data['User']['newPassword'], 'sha1', true); }
			if ($this->User->save($this->data))
				{
				$this->Session->setFlash('Edytowano '.$this->displayName, 'success');
				$this->redirect(array('action' => 'index'));
				}
			}
		if (empty($this->data))
			{
			$this->data = $this->User->read(null, $id);
			}
		$this->set('userTypes', $this->userTypes);
		}

	function admin_delete($id = null)
		{
		if (!$id)
			{
			$this->Session->setFlash('Nieprawidłowy '.$this->displayName, 'failure');
			$this->redirect(array('action' => 'index'));
			}
		if ($this->User->delete($id))
			{
			$this->Session->setFlash('Usunięto '.$this->displayName, 'success');
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
				$this->Session->setFlash('Dodano', 'success');
				$this->redirect(array('action' => 'permissions'));
				}
			}
		$this->set('users', $this->User->find('list', array('conditions' => array('User.type >=' => '2'))));
    $this->set('permissions', $this->Permission->find('list'));
    }
    
  function admin_delete_permission($user_id = null, $permission_id = null)
		{
		if ($this->User->habtmDelete('Permission', $user_id, $permission_id))
			{
			$this->Session->setFlash('Usunięto', 'success');
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
?>