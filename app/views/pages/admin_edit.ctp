<h2>Strony</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Strony', array('action' => 'index')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('Page'); ?>
  <fieldset>
    <?php
    echo $form->input('title', array('label' => 'Tytuł'));
    echo $form->input('body', array('label' => 'Treść', 'type' => 'textarea'));
    ?>
  </fieldset>
<?php echo $form->end('Edytuj'); ?>
</div>