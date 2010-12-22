<?php
class AppController extends Controller {

  var $components = array('Auth', 'Session');
	
	var $helpers = array('Form', 'Html', 'Js', 'Session', 'Text');
 
	function beforeFilter()
		{
    $this->Auth->authorize = 'controller';
    $this->Auth->userScope = array('User.type > 0');
    $this->Auth->authenticate = ClassRegistry::init('User');
    $this->Auth->autoRedirect = false;
    $this->Auth->logoutRedirect =  array('controller' => 'users', 'action' => 'login');
		
    $this->Auth->loginError = 'Niepoprawna nazwa użytkownika lub hasło!';
		$this->Auth->authError = 'Niestety, nie masz tu dostępu!';
		
		if (isset($this->params['prefix']) AND $this->params['prefix'] == 'admin')
			{
			$this->Auth->autoRedirect = true;
      $this->layout = 'admin';
			$this->Auth->userScope = array('User.type > 1');
			if ($this->Auth->user())
        {
        $this->set('user', $this->Auth->user());
        } else {
        $this->layout = 'admin_login';
        }
      } else {
      $this->Auth->allow('*');
      if ($this->name == 'Posts')
        {
        $this->layout = 'default';
        } else{
        $this->layout = 'page';
        }
			}
		}
		
	function isAuthorized()
    {
    return $this->_permitted($this->name, $this->action);
    }

  function _permitted($controller, $action)
    {
    $this->loadModel('User');
    $controller = low($controller);
    $action = low($action);
    $this->Session->delete('User.Permissions');
    if(!$this->Session->check('User.Permissions'))
      {
      $permissions = array();
      $permissions[] = 'users:admin_logout';
      $permissions[] = 'users:admin_login';
      $this->User->unbindModel(array('hasMany' => array('Post', 'Comment')));
      $thisUser = $this->User->find(array('User.id' => $this->Auth->user('id')));
      foreach($thisUser['Permission'] as $permission)
        {
        $permissions[] = $permission['name'];
        }
      $this->Session->write('User.Permissions', $permissions);
      } else {
      $permissions = $this->Session->read('User.Permissions');
      }
    
    foreach($permissions as $permission)
      {
      if($permission == '*')
        {
        return true;
        }
      if($permission == $controller.':*')
        {
        return true;
        }
      if($permission == $controller.':'.$action)
        {
        return true;
        }
      }
    return false;
    }

}
?>