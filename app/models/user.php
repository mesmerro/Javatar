<?php
class User extends AppModel {
	
	var $actsAs = 'ExtendAssociations';
  
  var $displayField = 'username';
	
	var $order = 'User.username';
	
	var $validate = array(
    'username' => array(
      'rule1' => array(
        'rule'    => 'alphaNumeric',
        'message' => 'Tylko litery i cyfry.'
        ),
      'rule2' => array(
        'rule'    => array('minLength', 3),
        'message' => 'Nie mniej niż 3 znaki.' 
        ),
      'rule3' => array(
        'rule'    => array('maxLength', 25),
        'message' => 'Nie więcej niż 25 znaków.' 
        ),
      'rule4' => array(
        'rule'    => 'isUnique',
        'on'      => 'create',
        'message' => 'Jest już w bazie.'
        )
      )
    );

	var $hasMany = array(
		'Post' => array(
			'className'  => 'Post',
			'foreignKey' => 'user_id',
			'dependent'  => false
      ),
    'Comment' => array(
			'className'  => 'Comment',
			'foreignKey' => 'user_id',
			'dependent'  => false
      )
    );
    
  var $hasAndBelongsToMany = array(
    'Permission' => array(
      'className'             => 'Permission',
      'joinTable'             => 'permissions_users',
      'foreignKey'            => 'user_id',
      'associationForeignKey' => 'permission_id',
      'unique'                => true
      )
    );

}
?>