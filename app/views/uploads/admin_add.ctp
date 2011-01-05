<h2>Pliki</h2>
<div class="form">
<?php echo $form->create('Upload', array('type' => 'file')); ?>
  <fieldset>
    <?php
    echo $form->input('file', array('label' => 'Plik', 'type' => 'file'));
    ?>
  </fieldset>
<?php echo $form->end('Wgraj obrazek'); ?>
</div>