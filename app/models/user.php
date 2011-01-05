<?php
class User extends AppModel {
	
	var $actsAs = array('ExtendAssociations');
  
  var $displayField = 'username';
	
	var $order = 'User.username'; 
	
	var $validate = array(
    'email' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule' => array('email', true),
        'message' => 'To nie jest poprawny adres email.'
        ),
      'rule3' => array(
        'rule'    => 'isUnique',
        'message' => 'Ten adres email znajduje się już w bazie.'
        )
      ),
    'register_email' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule' => array('email', true),
        'message' => 'To nie jest poprawny adres email.'
        ),
      'rule3' => array(
        'rule'    => array('_isUniqueEmail'),
        'on'      => 'create',
        'message' => 'Ten adres email znajduje się już w bazie.'
        )
      ),
    'username' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule'    => 'alphaNumeric',
        'message' => 'Tylko litery i cyfry.'
        ),
      'rule3' => array(
        'rule'    => array('minLength', 3),
        'message' => 'Nie mniej niż 3 znaki.' 
        ),
      'rule4' => array(
        'rule'    => array('maxLength', 25),
        'message' => 'Nie więcej niż 25 znaków.' 
        ),
      'rule5' => array(
        'rule'    => 'isUnique',
        'message' => 'Ten login znajduje się już w bazie.'
        )
      ),
    'register_username' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule'    => 'alphaNumeric',
        'message' => 'Tylko litery i cyfry.'
        ),
      'rule3' => array(
        'rule'    => array('minLength', 3),
        'message' => 'Nie mniej niż 3 znaki.' 
        ),
      'rule4' => array(
        'rule'    => array('maxLength', 25),
        'message' => 'Nie więcej niż 25 znaków.' 
        ),
      'rule5' => array(
        'rule'    => array('_isUniqueUser'),
        'on'      => 'create',
        'message' => 'Ten login znajduje się już w bazie.'
        )
      ),
    'register_password' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        )
      ),
    'register_password_again' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule' => array('_identicalFieldValues', 'register_password'),
        'message' => 'Hasła się nie zgadzają.'
        )
      ),
    'profile_password' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        )
      ),
    'profile_password_again' => array(
      'rule1' => array( 
        'rule' => 'notEmpty',
        'message' => 'Pole nie może być puste.',
        'last' => true
        ),
      'rule2' => array(
        'rule' => array('_identicalFieldValues', 'profile_password'),
        'message' => 'Hasła się nie zgadzają.'
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
    
  function _identicalFieldValues($field = array(), $compare_field = null) 
    {
    foreach($field as $key => $value)
      {
      $v1 = $value;
      $v2 = $this->data[$this->name][$compare_field];                 
      if($v1 !== $v2)
        {
        return false;
        } else {
        continue;
        }
      }
    return true;
    }
  
  function _isUniqueUser()
    {
    return ($this->find('count', array('conditions' => array('User.username' => $this->data['User']['register_username']))) == 0);
    }
    
  function _isUniqueEmail()
    {
    return ($this->find('count', array('conditions' => array('User.email' => $this->data['User']['register_email']))) == 0);
    }


}
