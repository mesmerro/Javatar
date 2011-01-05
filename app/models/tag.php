<?php
class Tag extends AppModel {
  
  var $order = 'Tag.name ASC';
  
  var $validate = array(
    'name' => array(
      'rule1' => array(
        'rule'    => 'alphaNumeric',
        'message' => 'Tylko litery i cyfry.'
        ),
      'rule2' => array(
        'rule'    => array('maxLength', 25),
        'message' => 'Nie więcej niż 25 znaków.' 
        ),
      'rule3' => array(
        'rule'    => 'isUnique',
        'on'      => 'create',
        'message' => 'Jest już w bazie.'
        )
      )
    );
  
  var $hasAndBelongsToMany = array(
    'Post' => array(
      'className'             => 'Post',
      'joinTable'             => 'posts_tags',
      'foreignKey'            => 'tag_id',
      'associationForeignKey' => 'post_id',
      'unique'                => true
      )
    );

}