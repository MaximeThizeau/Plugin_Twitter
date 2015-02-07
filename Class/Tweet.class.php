<?php

include_once("./autoload.inc.php");
include_once("./simple_html_dom.php");

class Tweet{


  private $page;
  private $date = "";
  private $link_array = Array();
  private $author = "";
  private $author_login = "";
  private $HTML_code;
  private $at_reply = Array();
  private $position;
  private $content = "";

  public function __construct($page, $position)
  {

    $this->page = $page;

    try {
      $html = file_get_html($this->page->getUrl());
      $this->HTML_code = $html->find(".GridTimeline .GridTimeline-items .Grid .Grid-cell .ProfileTweet", $position);
    } catch (Exception $e) {  echo 'Une erreur s\'est produite : ',  $e->getMessage(), "\n"; }

    $this->recordAll();


  }


  public function recordDate()
  {
      $this->date = $this->HTML_code->find(".js-short-timestamp", 0)->plaintext;
  }

  public function recordAuthor()
  {
      $this->author = $this->HTML_code->find(".ProfileTweet-fullname", 0)->plaintext;
  }

  public function recordAtReply()
  {
      foreach($this->HTML_code->find(".twitter-atreply") as $twitter_atreply)
      {
        $this->at_reply[] = $twitter_atreply->plaintext;
      }
  }

  public function recordLinks()
  {
    if($links = $this->HTML_code->find(".twitter-timeline-link"))
    {
      foreach($links as $link)
      {
        if($link->find("span.tco-ellipsis", 0))
            $link->find("span.tco-ellipsis", 0)->outertext=""; // Remove useless div and hidden informations that we don't want

        $this->link_array[] = str_replace(" ", "", str_replace("&nbsp;", "", $link->plaintext)); // Removing space from link
      }
    }
  }

  public function recordContent()
  {
    $content = $this->HTML_code->find(".ProfileTweet-contents .ProfileTweet-text",0)->plaintext;

    foreach($this->link_array as $link)
    {
      $to_replace_with = "<a href=\"//" .$link ."\">".$link."</a>";
      $content = str_replace(trim(str_replace("http://", "http:// ", $link)), $to_replace_with, $content);
    }

    foreach($this->at_reply as $reply)
    {
      $to_replace_with = "<a href=\"//www.twitter.com/".str_replace("@", "", $reply)."\">". $reply. "</a>";
      $content = str_replace($reply, $to_replace_with, $content);
    }
    $this->content = $content;
  }

  public function recordAuthor_login()
  {
    $this->author_login = str_replace(" ", "", $this->HTML_code->find(".ProfileTweet-screenname", 0)->plaintext);
  }

  public function recordAll()
  {
    $this->recordDate();
    $this->recordAuthor();
    $this->recordAtReply();
    $this->recordLinks();
    $this->recordContent();
    $this->recordAuthor_login();
  }

  //Accesseurs / Getters
  public function getPage() { return $this->page; }
  public function getDate() { return $this->date; }
  public function getLink_array() { return $this->link_array; }
  public function getAuthor() { return $this->author; }
  public function getHTML_code() { return $this->HTML_code; }
  public function getAt_reply() { return $this->at_reply; }
  public function getPosition() { return $this->position; }
  public function getContent() { return $this->content; }
  public function getAuthor_login() { return $this->author_login; }

  // Mutateurs / Setters
  public function setLink_array($link_array) {  $this->link_array = $link_array ;}
  public function setAt_reply($at_reply) {  $this->at_reply = $at_reply ;}

}

?>
