<div class="form">
<?php echo $form->create('User'); ?>
  <fieldset>
    <?php
    echo $form->input('username', array('label' => 'Login'));
    echo $form->input('password', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
    ?>
  </fieldset>
<?php echo $form->end('Zarejestruj'); ?>
</div>