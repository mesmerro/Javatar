<?php
class PostsTag extends AppModel {

  public $belongsTo = array('Post', 'Tag');

}
?>