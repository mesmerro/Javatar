<h2>Komentarze</h2>
<table cellpadding="0" cellspacing="0">
  <tr>
    <th class="small"><?php echo $paginator->sort('id'); ?></th>
    <th><?php echo $paginator->sort('Treść', 'body'); ?></th>
    <th class="small"><?php echo $paginator->sort('Użytkownik', 'username'); ?></th>
    <th class="small"><?php echo $paginator->sort('Post', 'post_id'); ?></th>
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
    <td><?php echo $field['Comment']['id']; ?></td>
    <td class="left"><?php echo $this->Text->truncate($field['Comment']['body'], 35); ?></td>
    <td><?php echo $field['User']['username']; ?></td>
    <td class="nowrap"><?php echo $this->Text->truncate($field['Post']['title'], 20); ?></td>
    <td class="nowrap"><?php echo $field['Comment']['created']; ?></td>
    <td>
      <?php
      echo $html->link('Edytuj', array('action' => 'edit', $field['Comment']['id']));
      echo '&nbsp;';
      echo $html->link('Usuń', array('action' => 'delete', $field['Comment']['id']), null, 'Na pewno usunąć #'.$field['Comment']['id'].'?');
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