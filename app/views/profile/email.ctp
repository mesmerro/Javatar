<h2>Panel użytkownika » Zmień adres email</h2>
<?php
echo $form->create('User', array('url' => array('controller' => 'profile', 'action' => 'email'), 'inputDefaults' => array('autocomplete' => 'off')));
  echo $form->input('email', array('label' => 'Adres email'));
echo $form->end('Edytuj');
?>