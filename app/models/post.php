<?php
class Post extends AppModel {
	
  var $order = 'Post.created DESC';
  
  var $virtualFields = array(
    'short_body' => 'SUBSTRING_INDEX(Post.body, "<full_body>", "1")',
    'full_body' => 'REPLACE(Post.body, "<full_body>", "")' 
    );
    
  var $validate = array(
    'title' => array(
      'rule1' => array(
        'rule' => array('minLength', 5),
        'message' => 'Nie mniej niż 5 znaków.' 
        ),
      'rule2' => array(
        'rule' => array('maxLength', 100),
        'message' => 'Nie więcej niż 100 znaków.' 
        )
      ),
    'body' => array(
      'rule1' => array(
        'rule' => array('maxLength', 5000),
        'message' => 'Nie więcej niż 5000 znaków.' 
        )
      )
    );

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		  )
    );
    
  var $hasMany = array(
    'Comment' => array(
			'className'  => 'Comment',
			'foreignKey' => 'post_id',
			'dependent'  => false
      )
    );
	
	var $hasAndBelongsToMany = array(
    'Tag' => array(
      'className'             => 'Tag',
      'joinTable'             => 'posts_tags',
      'foreignKey'            => 'post_id',
      'associationForeignKey' => 'tag_id',
      'unique'                => true
      )
    );
    
  function checkIfUserHasAvatar($image)
    {
    if (!empty($image))
      {
      return $image;
      } else {
      return 'http://lfc.pl/images/default-avatar.gif';
      }
    }
    
  function getPostWithComments($id = null)
    {
    $this->unbindModel(array('hasMany' => array('Comment')));
		$conditionsForPost = array(
      'conditions' => array('Post.id' => $id),
      'fields' => array('Post.id', 'Post.created', 'Post.title', 'Post.full_body', 'User.username')
      );
    $post = $this->find('first', $conditionsForPost);
      
    $this->Comment->unbindModel(array('belongsTo' => array('Post')));
    $conditionsForComments = array(
      'conditions' => array('Comment.post_id' => $id),
      'fields' => array('Comment.id', 'Comment.hour', 'Comment.body', 'User.username', 'User.avatar')
      );
    $comments = array('Comment' => $this->Comment->find('all', $conditionsForComments));      
    for ($i = 0; $i < count($comments['Comment']); $i++)
      {
      $comments['Comment'][$i]['User']['avatar'] = $this->checkIfUserHasAvatar($comments['Comment'][$i]['User']['avatar']);
      }
      
		return array_merge($post, $comments);
    }

}
?>