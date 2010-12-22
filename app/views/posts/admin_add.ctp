<h2>Newsy</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Newsy', array('action' => 'index')); ?></li>
  </ul>
</div>
<div class="form">
<?php echo $form->create('Post'); ?>
  <fieldset>
    <?php
    echo $form->input('user_id', array('type' => 'hidden', 'value' => $session->read('Auth.User.id')));
    echo $form->input('title', array('label' => 'Tytuł'));
    echo $form->input('body', array('label' => 'Treść', 'type' => 'textarea'));
    echo $form->input('Tag', array('label' => 'Tagi', 'type' => 'select', 'multiple' => 'checkbox', 'class' => 'checkbox'));
    ?>
  </fieldset>
<?php echo $form->end('Dodaj'); ?>
</div>