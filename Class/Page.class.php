<?php

include_once("./autoload.inc.php");
include_once("./simple_html_dom.php");

class Page{

  private $url;
  private $username = "";
  private $login = "";

  public function __construct($url)
  {
    $this->url = $url;

    if ($html = file_get_html($this->url)){
        $this->username = $html->find(".ProfileHeaderCard .ProfileHeaderCard-name .ProfileHeaderCard-nameLink",0)->plaintext;
        $this->login = $html->find(".ProfileHeaderCard .ProfileHeaderCard-screenname .u-linkComplex-target",0)->plaintext;
    }

  }

  public function getUrl()  { return $this->url; }
  public function getUsername()  { return $this->username; }
  public function getLogin()  { return $this->login; }
}

?>
