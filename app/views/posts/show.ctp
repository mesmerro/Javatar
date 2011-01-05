<div class="post">
  <div class="post-title"><?php echo $field['Post']['title']; ?></div>
  <div class="post-body"><?php echo nl2br($field['Post']['full_body']); ?></div>
  <div class="post-info">dodał: <span class="bold"><?php echo $field['User']['username']; ?></span> | data: <span class="bold"><?php echo $this->Date->getNiceDate($field['Post']['created']); ?></span> | tagi: <?php foreach ($field['Tag'] AS $tag) { echo '<a href="/tag/'.$tag['name'].'">'.$tag['name'].'</a> '; } ?></div>
</div>
<h3>Komentarze</h3>
<?php
$i = 0;
foreach ($field['Comment'] as $comment)
	{
	$class = null;
	if ($i++ % 2 == 0) { $class = ' altrow'; }
?>
<div class="comment<?php echo $class; ?>">
  <div class="comment-headline"><span class="comment-author"><?php echo $comment['User']['username'] ?></span> napisał o <?php echo $comment['Comment']['hour']; ?>:</div>
  <div class="comment-image"><img src="<?php echo $comment['User']['avatar'] ?>" alt="" /></div>
  <p class="comment-body"><?php echo nl2br($comment['Comment']['body']); ?></p>
  <div class="clear"></div>
</div>
<?php
	}
?>
<h3>Dodaj komentarz</h3>
<?php if(!$this->Session->check('Auth.User')) { ?>
<div id="flashMessage" class="notice">
  Musisz być zalogowany, by móc dodawać komentarze.
</div>
<?php } else { ?>
<form action="/comments/add" method="post">
  <input type="hidden" value="POST" name="_method" />
  <input type="hidden" id="CommentPostId" value="<?php echo $field['Post']['id']; ?>" name="data[Comment][post_id]" />
  <textarea id="CommentBody" name="data[Comment][body]"></textarea><br />
  <input type="submit" value="Dodaj" style="margin-top: 5px;"/>
</form>
<?php } ?>