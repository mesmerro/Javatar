<h2>Login</h2>
<?php
echo $form->create('User', array('url' => array('action' => 'login')));
echo $form->input('username', array('label' => 'Nazwa użytkownika'));
echo $form->input('password', array('label' => 'Hasło'));
echo $form->end('Zaloguj');
?>