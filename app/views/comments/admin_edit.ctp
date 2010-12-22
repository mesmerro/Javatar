<h2>Komentarze</h2>
<div class="form">
<?php echo $form->create('Comment'); ?>
  <fieldset>
<?php
    echo $form->input('post_id', array('type' => 'hidden'));
    echo $form->input('body', array('type' => 'textarea'));
?>
  </fieldset>
<?php echo $form->end('Edytuj'); ?>
</div>