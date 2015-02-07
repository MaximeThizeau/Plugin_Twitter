<?php

  include_once("autoload.inc.php");


  $page = new Page("https://twitter.com/CosteAntonin");
  echo "<br><b>Url : </b>". $page->getUrl();
  echo "<br><b>Username : </b>". $page->getUsername();
  echo "<br><b>Login : </b>". $page->getLogin();
  echo "<br><br>";

  for($i = 0; $i < 10; $i++)
  {
    echo "<br>--------------------------------";
    $tweet = new Tweet($page, $i);
    echo "<br><b>Date : </b>". $tweet->getDate();
    echo "<br><b>Author : </b>". $tweet->getAuthor();
    echo "<br><b>Author Login: </b>". $tweet->getAuthor_login();
    echo "<br><b>Content : </b>". $tweet->getContent();
    foreach($tweet->getLink_array() as $link)
    {
      echo "<br><b>Link : </b>". $link;
    }
  }
?>
