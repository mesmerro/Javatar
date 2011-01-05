<?php if(isset($notice)) { ?>
<div id="flashMessage" class="notice">
  <?php echo $notice; ?>
</div>
<?php } ?>
<h2>Uprawnienia użytkowników</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Nowy uprawnienie dla użytkownika', array('action' => 'add_permission')); ?></li>
  </ul>
</div>
<table cellpadding="0" cellspacing="0">
  <tr>
    <th class="small">Id</th>
    <th>Użytkownik</th> 
    <th>Uprawnienie</th>
    <th class="small">Opcje</th>
  </tr>
<?php
$i = 0;
foreach ($fields as $field)
	{
	$class = null;
	if ($i++ % 2 == 0) { $class = ' class="altrow"'; }
  echo '<tr '.$class.'>'; ?>
    <td><?php echo $field['User']['id'].'/'.$field['Permission']['id']; ?></td>
    <td class="left"><?php echo $field['User']['username']; ?></td>
    <td class="left"><?php echo $field['Permission']['name']; ?></td>
    <td>
      <?php
      echo $html->link('Usuń', array('action' => 'delete_permission', $field['User']['id'].'/'.$field['Permission']['id']), null, 'Na pewno usunać "'.$field['User']['username'].'/'.$field['Permission']['name'].'"?');
      ?>
    </td>
  </tr>
<?php
	}
?>
</table>