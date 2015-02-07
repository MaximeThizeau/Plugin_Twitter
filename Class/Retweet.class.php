<?php

include_once("./autoload.inc.php");
include_once("./simple_html_dom.php");

class Retweet extends Tweet{

  private $author_link;

  public function __construct(Tweet $tweet)
  {
      parent::__construct($tweet->getPage(), $tweet->getPosition());
  }

  public function recordContent()
  {
      
  }


  public function getAuthorLink() { return $this->author_link; }
  public function getContent() { return $this->content; }

}

?>
