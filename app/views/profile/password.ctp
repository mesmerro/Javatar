<h2>Panel użytkownika » Zmień hasło</h2>
<?php
echo $form->create('User', array('url' => array('controller' => 'profile', 'action' => 'password'), 'inputDefaults' => array('autocomplete' => 'off')));
  echo $form->input('profile_password', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
  echo $form->input('profile_password_again', array('label' => 'Powtórz hasło', 'type' => 'password', 'value' => ''));    
echo $form->end('Edytuj');
?>