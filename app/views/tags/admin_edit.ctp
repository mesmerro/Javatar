<h2>Tagi</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Tagi', array('action' => 'index')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('Tag'); ?>
  <fieldset>
    <?php
    echo $form->input('id', array('type' => 'hidden'));
    echo $form->input('username', array('label' => 'Nazwa'));
    echo $form->input('password', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
    echo $form->input('type', array('label' => 'Typ', 'type' => 'select', 'options' => $userTypes));
    ?>
  </fieldset>
<?php echo $form->end('Edytuj'); ?>
</div>