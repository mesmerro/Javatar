<?php
class Page extends AppModel {
	
  var $order = 'Page.title ASC';
  
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
      )
    );

}
?>