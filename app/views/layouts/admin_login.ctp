<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php echo $html->css('admin'); ?>
<title>Panel administracyjny</title>
</head>
<body>
<div id="container">
  <?php
  echo $this->Session->flash();
  echo $this->Session->flash('auth');
  echo $content_for_layout;
  ?>
<div id="copyright"><a href="mailto:pawelmysior@gmail.com">Paweł Mysior</a><br /><a href="http://cakephp.org/"><img src="/img/cake.power.gif" alt="CakePHP Power" /></a></div>
</body>
</html>