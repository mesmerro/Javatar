<h2>Szukaj</h2>
<?php
echo $form->create('Post', array('url' => array('action' => 'archive')));
  echo $form->input('search', array('label' => 'Hasło'));
echo $form->end('Szukaj');
?>            