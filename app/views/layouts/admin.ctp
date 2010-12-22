<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php echo $html->css('admin'); ?>
<title>Panel administracyjny</title>
</head>
<body>
<div id="container">
  <h1>Panel administracyjny</h1>
  <?php if ($user) { ?>
  <div id="navigation">
    <ul>
      <li><?php echo $html->link('Newsy', array('controller' => 'posts', 'action' => 'index')); ?></li>
      <li><?php echo $html->link('Strony', array('controller' => 'pages', 'action' => 'index')); ?></li>
      <li><?php echo $html->link('Tagi', array('controller' => 'tags', 'action' => 'index')); ?></li>
      <li><?php echo $html->link('Użytkownicy', array('controller' => 'users', 'action' => 'index')); ?></li>
      <li><?php echo $html->link('Uprawnienia', array('controller' => 'permissions', 'action' => 'index')); ?></li>
    </ul>
  </div>
  <?php } ?>
  <div id="content">
    <?php
    echo $this->Session->flash();
    echo $this->Session->flash('auth');
    echo $content_for_layout;
    ?>
  </div>
  <?php if ($user) { ?><div id="logout"><?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></div><?php } ?>
</div>
<div id="copyright"><a href="mailto:pawelmysior@gmail.com">Paweł Mysior</a><br /><a href="http://cakephp.org/"><img src="/img/cake.power.gif" alt="CakePHP Power" /></a></div>
</body>
</html>