<?php
class Post extends AppModel {
	
  var $order = 'Post.created DESC';
  
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
			'foreignKey' => 'user_id',
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

}
?>