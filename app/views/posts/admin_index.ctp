<h2>Newsy</h2>
<div class="actions">
  <ul>
    <li><?php echo $html->link('Nowy news', array('action' => 'add')); ?></li>
  </ul>
</div>
<table cellpadding="0" cellspacing="0">
  <tr>
    <th class="small"><?php echo $paginator->sort('id'); ?></th>
    <th><?php echo $paginator->sort('Tytuł', 'title'); ?></th>
    <th class="small"><?php echo $paginator->sort('Użytkownik', 'username'); ?></th>
    <th class="small nowrap"><?php echo $paginator->sort('Data dodania', 'created'); ?></th>
    <th class="small">Opcje</th>
  </tr>
<?php
$i = 0;
foreach ($fields as $field)
	{
	$class = null;
	if ($i++ % 2 == 0) { $class = ' class="altrow"'; }
  echo '<tr '.$class.'>'; ?>
    <td><?php echo $field['Post']['id']; ?></td>
    <td class="left"><?php echo $field['Post']['title']; ?></td>
    <td><?php echo $field['User']['username']; ?></td>
    <td class="nowrap"><?php echo $field['Post']['created']; ?></td>
    <td>
      <?php
      echo $html->link('Edytuj', array('action' => 'edit', $field['Post']['id']));
      echo '&nbsp;';
      echo $html->link('Usuń', array('action' => 'delete', $field['Post']['id']), null, 'Na pewno usunąć "'.$field['Post']['title'].'"?');
      echo '&nbsp;';
      echo $html->link('Komentarze', array('controller' => 'comments', $field['Post']['id']));
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