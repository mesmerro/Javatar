<h2>Uprawnienia</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Nowe uprawnienie', array('action' => 'add')); ?></li>
  </ul>
</div>
<table cellpadding="0" cellspacing="0">
  <tr>
    <th class="small"><?php echo $paginator->sort('id'); ?></th>
    <th><?php echo $paginator->sort('Uprawnienie', 'name'); ?></th>
    <th class="small"><?php echo $paginator->sort('Data dodania', 'created'); ?></th>
    <th class="small">Opcje</th>
  </tr>
<?php
$i = 0;
foreach ($fields as $field)
	{
	$class = null;
	if ($i++ % 2 == 0) { $class = ' class="altrow"'; }
  echo '<tr '.$class.'>'; ?>
    <td><?php echo $field['Permission']['id']; ?></td>
    <td class="left"><?php echo $field['Permission']['name']; ?></td>
    <td class="nowrap"><?php echo $field['Permission']['created']; ?></td>
    <td>
      <?php
      echo $html->link('Edytuj', array('action' => 'edit', $field['Permission']['id']));
      echo '&nbsp;';
      echo $html->link('Usuń', array('action' => 'delete', $field['Permission']['id']), null, 'Na pewno usunać "'.$field['Permission']['name'].'"?');
      ?>
    </td>
  </tr>
<?php
	}
?>
</table>
<div class="paging">
<?php
	echo '<div class="counter">'.$paginator->counter(array('format' => 'Strona %page% z %pages%')).'</div>';
	echo '<div class="links"><span class="prev">'.$paginator->prev('« Poprzednia ', null, null).'</span>';
	echo $paginator->numbers();
	echo '<span class="next">'.$paginator->next(' Następna »', null, null).'</span></div>';
?>
</div>