<h2>Panel użytkownika » Zmiań avatar</h2>
<?php
echo $form->create('User', array('url' => array('controller' => 'profile', 'action' => 'avatar'), 'inputDefaults' => array('autocomplete' => 'off')));
  echo $form->input('avatar', array('label' => 'Avatar'));
echo $form->end('Edytuj');
?>