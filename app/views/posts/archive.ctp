<h2>Wyniki wyszukiwania</h2>
<?php
if (!empty($fields))
  {
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
  if ($this->Paginator->hasPage(2))
    {
  ?>
  <div class="paging">
    <?php
    $this->Paginator->options(array('url' => $this->passedArgs));
    echo $this->Paginator->prev('« Poprzednia ', null, null);
  	echo $this->Paginator->numbers();
  	echo $this->Paginator->next(' Następna »', null, null);	
  ?>
  </div>
  <?php
    }
  } else {
  echo 'Brak wyników dla tego hasła';
  }
  ?>