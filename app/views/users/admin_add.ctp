<h2>Użytkownicy</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Użytkownicy', array('action' => 'index')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('User'); ?>
  <fieldset>
    <?php
    echo $form->input('username', array('label' => 'Nazwa'));
    echo $form->input('newPassword', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
    echo $form->input('type', array('label' => 'Typ', 'type' => 'select', 'options' => $userTypes));
    ?>
  </fieldset>
<?php echo $form->end('Dodaj'); ?>
</div>