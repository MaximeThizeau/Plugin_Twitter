

<?php
include_once("autoload.inc.php");

set_time_limit(0);
include('simple_html_dom.php');

$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = "https://twitter.com/MaximeThizeau";
$tweet_context = "";
$link_array = Array();
?>

<?php


// S'il y a un problème avec l'URL que l'on crawl, on passe à la suivante et on met à jour en disant qu'on la faîte.
if (file_get_html($url) == false OR file_get_contents($url) == false){
  //Error
}

echo "<h2>Url crawled : ". $url.'</h2>' ;

// On récupère le contenu de la page que l'on crawl.
$html = file_get_html($url);

$first_tweet = $html->find(".GridTimeline .GridTimeline-items .Grid .Grid-cell .ProfileTweet", 0);
echo $first_tweet;

$profile_context = $first_tweet->find(".ProfileTweet-header .ProfileTweet-context", 0)->plaintext;

// Want to know if it's a simple tweet of RT
if(preg_match("#a Retweeté#", $profile_context))
  {
    echo "C'est un retweet";
    $tweet_context = "retweet";
    $author = $first_tweet->find(".ProfileTweet-fullname", 0)->plaintext;
    $link_author = $first_tweet->find(".ProfileTweet-screenname", 0)->plaintext;
    $link_author = "//www.twitter.com/".trim(explode("@", $link_author)[1]);
    $date = $first_tweet->find(".js-short-timestamp", 0)->plaintext;
    $content = $first_tweet->find(".ProfileTweet-contents .ProfileTweet-text",0);
    if($content->find(".twitter-timeline-link"))
    {
        foreach($content->find(".twitter-timeline-link") as $link)
        {
          $link->find("span.tco-ellipsis", 0)->outertext=""; // Remove useless div and hidden informations that we don't want
          $link_array[] = str_replace(" ", "", str_replace("&nbsp;", "", $link->plaintext)); // Removing space from link
        }
    }

    $twitter_atreply = $content->find(".twitter-atreply", 0);
    $via_reply = trim($twitter_atreply->plaintext);

    $content = $content->plaintext; // Writing tweet content with good style

    foreach($link_array as $link)
    {
      $to_replace_with = "<a href=\"" .$link ."\">".$link."</a>";
      $content = str_replace(trim(str_replace("http://", "http:// ", $link)), $to_replace_with, $content);
    }

    $to_replace_with = "<a href=\"//www.twitter.com/".str_replace("@", "", $via_reply)."\">". $via_reply. "</a>";
    $content = str_replace($via_reply, $to_replace_with, $content);
  }

  if(preg_match("#a Retweeté#", $profile_context))
  {
    // echo "C'est un retweet";
    // $tweet_context = "retweet";
    // $author = $first_tweet->find(".ProfileTweet-fullname", 0)->plaintext;
    // $link_author = $first_tweet->find(".ProfileTweet-screenname", 0)->plaintext;
    // $link_author = "//www.twitter.com/".trim(explode("@", $link_author)[1]);
    // $date = $first_tweet->find(".js-short-timestamp", 0)->plaintext;
    // $content = $first_tweet->find(".ProfileTweet-contents .ProfileTweet-text",0);
    // if($content->find(".twitter-timeline-link"))
    // {
    //   foreach($content->find(".twitter-timeline-link") as $link)
    //   {
    //     $link->find("span.tco-ellipsis", 0)->outertext=""; // Remove useless div and hidden informations that we don't want
    //     $link_array[] = str_replace(" ", "", str_replace("&nbsp;", "", $link->plaintext)); // Removing space from link
    //   }
    // }
    //
    // $twitter_atreply = $content->find(".twitter-atreply", 0);
    // $via_reply = trim($twitter_atreply->plaintext);
    //
    // $content = $content->plaintext; // Writing tweet content with good style
    //
    // foreach($link_array as $link)
    // {
    //   $to_replace_with = "<a href=\"" .$link ."\">".$link."</a>";
    //   $content = str_replace(trim(str_replace("http://", "http:// ", $link)), $to_replace_with, $content);
    // }
    //
    // $to_replace_with = "<a href=\"//www.twitter.com/".str_replace("@", "", $via_reply)."\">". $via_reply. "</a>";
    // $content = str_replace($via_reply, $to_replace_with, $content);
  }




?>

<br><br><br> <h2> -------- Tweet : ---------</h2>

<?php // On écrit le tweet découpé ici
  echo "Context : ".utf8_decode($profile_context) ."<br>";
  echo "Author : ". utf8_decode($author) ."<br>";
  echo "Link Author : ". utf8_decode($link_author) ."<br>";
  echo "Date : ". utf8_decode($date) ."<br>";
  echo "Content : ". utf8_decode($content) ."<br>";

  foreach($link_array as $link)
  {
    echo "Link : ". utf8_decode($link) ."<br>";
  }


  echo "Via Reply : ". utf8_decode($via_reply) ."<br>";

?>



<?php
// redirectPage($currentUrl);
?>
