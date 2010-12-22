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
    echo $form->input('name', array('label' => 'Nazwa'));
?>
  </fieldset>
<?php echo $form->end('Dodaj'); ?>
</div>