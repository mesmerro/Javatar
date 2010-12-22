<?php
class Permission extends AppModel {
  
  var $order = 'Permission.name ASC';
  
  var $hasAndBelongsToMany = array(
    'User' => array(
      'className'             => 'User',
      'joinTable'             => 'permissions_users',
      'foreignKey'            => 'permission_id',
      'associationForeignKey' => 'user_id',
      'unique'                => true
      )
    );

}
?>