<?php
foreach ($fields as $field)
	{
?>
<div class="post">
  <div class="post-title"><a href="/post/<?php echo $field['Post']['id']; ?>"><?php echo $field['Post']['title']; ?></a></div>
  <div class="post-body"><?php echo nl2br($field['Post']['short_body']); ?></div>
  <div class="post-info">dodał: <span class="bold"><?php echo $field['User']['username']; ?></span> | data: <span class="bold"><?php echo $this->Date->getNiceDate($field['Post']['created']); ?></span> | tagi: <?php foreach ($field['Tag'] AS $tag) { echo '<a href="/tag/'.$tag['name'].'">'.$tag['name'].'</a> '; } ?> | komentarze: <span class="bold"><?php echo $field['Post']['comment_count']; ?></span></div>
</div>
<?php
  }
?>
<a href="/archive/" class="right">» Przejdź do archiwum</a>