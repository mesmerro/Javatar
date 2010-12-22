<h2>Uprawnienia użytkowników</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Uprawnienia użytkowników', array('action' => 'permissions')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('PermissionUser', array('url' => array('controller' => 'users', 'action' => 'add_permission'))); ?>
  <fieldset>
    <?php
    echo $form->input('user', array('label' => 'Użytkownik', 'type' => 'select'));
    echo $form->input('permission', array('label' => 'Uprawnienie', 'type' => 'select'));
    ?>
  </fieldset>
<?php echo $form->end('Dodaj'); ?>
</div>