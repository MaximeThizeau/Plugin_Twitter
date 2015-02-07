<?php

  include_once("autoload.inc.php");


  $page = new Page("Enter Your URL Here");
  echo "<br><b>Url : </b>". $page->getUrl();
  echo "<br><b>Username : </b>". $page->getUsername();
  echo "<br><b>Login : </b>". $page->getLogin();
  echo "<br><br>";


?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
  <?php
  for($i = 0; $i < 4; $i++)
  {
    echo "<div class=\"tweet\">";
    $tweet = new Tweet($page, $i);
    echo "<div class=\"tweet-header\">";
    echo $tweet->getAuthor();
    echo $tweet->getAuthor_login();
    echo $tweet->getDate();
    echo "</div>";


    echo "<br><b>Content : </b>". $tweet->getContent();
    foreach($tweet->getLink_array() as $link)
    {
      echo "<br><b>Link : </b>". $link;
    }
    echo "</div>";
  }

  ?>
</body>
</html>
