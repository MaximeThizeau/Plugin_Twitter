<?php

  include_once("autoload.inc.php");

  function PutTweetContext(Tweet $tweet)
  {
    $context = $tweet->getHTML_code->find(".ProfileTweet-header .ProfileTweet-context", 0)->plaintext;
    if(preg_match("#a Retweeté#", $context))
    {
      return new Retweet($tweet);
    }
  }

  $page = new Page("https://twitter.com/CosteAntonin");
  echo "<br><b>Url : </b>". $page->getUrl();
  echo "<br><b>Username : </b>". $page->getUsername();
  echo "<br><b>Login : </b>". $page->getLogin();
  echo "<br><br>";

  for($i = 0; $i < 3; $i++)
  {
    echo "<br>--------------------------------";
    $tweet = new Tweet($page, $i);
    echo "<br><b>Date : </b>". $tweet->getDate();
    echo "<br><b>Author : </b>". $tweet->getAuthor();
    echo "<br><b>At Reply : </b>". $tweet->getAt_reply();
    echo "<br><b>Content : </b>". $tweet->getContent();
    foreach($tweet->getLink_array() as $link)
    {
      echo "<br><b>Link : </b>". $link;
    }
  }
?>
