<h2>Formularz przywracania hasła</h2>
<?php
echo $form->create('User', array('url' => array('action' => 'lost_password')));
  echo $form->input('email', array('label' => 'Adres email'));
echo $form->end('Przywróć mi hasło');
?>