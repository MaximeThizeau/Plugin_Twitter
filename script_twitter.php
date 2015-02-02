<?php
set_time_limit(0);
include('simple_html_dom.php');

$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = "https://twitter.com/MaximeThizeau";
$tweet_context = "";
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
if(preg_match("#a Retweeté#", $profile_context))
  {
    echo "C'est un retweet";
    $tweet_context = "retweet";
    $author = $first_tweet->find(".ProfileTweet-fullname", 0)->plaintext;
    $link_author = $first_tweet->find(".ProfileTweet-screenname", 0)->plaintext;
    $link_author = "//www.twitter.com/".trim(explode("@", $link_author)[1]);
  }




?>

<br><br><br> <h2> -------- Tweet : ---------</h2>

<?php // On écrit le tweet découpé ici
  echo "Context : ".utf8_decode($profile_context) ."<br>";
  echo "Author : ". utf8_decode($author) ."<br>";
  echo "Link Author : ". utf8_decode($link_author) ."<br>";

?>



<?php
// redirectPage($currentUrl);
?>
