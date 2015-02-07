<?php

include_once("./autoload.inc.php");
include_once("./simple_html_dom.php");

class Tweet extends Tweet{

  private $content;

  public function __construct($page, $date, $position, $content)
  {
    parent::__construct($page, $date, $position, $author);
    $this->content = $content;
  }

  public function getAuthor() { return $this->author; }
  public function getAuthorLink() { return $this->author_link; }
  public function getContent() { return $this->content; }

}

?>
