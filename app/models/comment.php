<?php
class Comment extends AppModel {
	
  var $order = 'Comment.created DESC';
  
  var $validate = array(
    'body' => array(
      'rule1' => array(
        'rule' => array('maxLength', 1000),
        'message' => 'Nie więcej niż 1000 znaków.' 
        )
      )
    );

	var $belongsTo = array(
		'Post' => array(
			'className'    => 'Post',
			'foreignKey'   => 'post_id',
			'counterCache' => true
		  ),
    'User' => array(
			'className'    => 'User',
			'foreignKey'   => 'user_id',
			'counterCache' => true
		  )
    );

}
?>