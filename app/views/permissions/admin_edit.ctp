<h2>Uprawnienia</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Uprawnienia', array('action' => 'index')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('Permission'); ?>
  <fieldset>
    <?php
    echo $form->input('name', array('label' => 'Nazwa'));
    ?>
  </fieldset>
<?php echo $form->end('Edytuj'); ?>
</div>