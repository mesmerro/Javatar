<h2>Rejestracja</h2>
<?php if(isset($notice)) { ?>
<div id="flashMessage" class="notice">
  <?php echo $notice; ?>
</div>
<?php } ?>
<div class="form">
<?php echo $form->create('User', array('inputDefaults' => array('autocomplete' => 'off'))); ?>
  <fieldset>
    <?php
    echo $form->input('register_email', array('label' => 'Adres email'));
    echo $form->input('register_username', array('label' => 'Login'));
    echo $form->input('register_password', array('label' => 'Hasło', 'type' => 'password', 'value' => ''));
    echo $form->input('register_password_again', array('label' => 'Powtórz hasło', 'type' => 'password', 'value' => ''));
    echo $form->input('register_avatar', array('label' => 'Avatar'));
    ?>
  </fieldset>
<?php echo $form->end('Zarejestruj'); ?>
</div>