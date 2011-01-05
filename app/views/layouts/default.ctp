<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php echo $html->css('main'); ?>
<title>JavatarBlog</title>
</head>
<body>
<div id="container">
  <div id="logo"><a href="http://javatar.lfc.pl"><span class="bold">Javatar</span>Blog</a></div>
  <div id="content">
    <div id="left">
      <?php 
      echo $this->Session->flash();
      echo $this->Session->flash('auth');
      echo $content_for_layout;
      ?>
    </div>
    <div id="right">
      <div class="box">
        <div class="box-title">Zaloguj się</div>
        <div class="box-content">
          <?php
          if (!$this->Session->check('Auth.User'))
            {
            echo $form->create('User', array('url' => array('action' => 'login'), 'id' => 'UserLoginForm'));
            echo $form->input('username', array('label' => 'Nazwa użytkownika'));
            echo $form->input('password', array('label' => 'Hasło'));
            echo $form->end('Zaloguj');
            echo '<a href="/lost_password">» Zapomniałem hasła</a><br /><a href="/register">» Rejestracja</a>';
            } else {
            ?>
            Witaj <span class="bold"><?php echo $this->Session->read('Auth.User.username'); ?></span><br />
            <a href="/profile">» Edycja profilu</a><br />
            <a href="/logout">» Wyloguj</a>
            <?php
            }
          ?>
        </div>
      </div>
      <div class="box">
        <div class="box-title">Strony</div>
        <div class="box-content" style="background-color: #87BCD6;">
          <?php
          foreach ($pages AS $page)
            {
            echo '<a href="/page/'.$page['Page']['nice_url'].'">» '.$page['Page']['title'].'</a><br />';
            }
          ?>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div id="footer">created 2010 by <span class="bold"><a href="http://javatar.lfc.pl">JavatarTeam</a></span></div>
</div>
</body>
</html>