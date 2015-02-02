<?php
set_time_limit(0);
include('simple_html_dom.php');

$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = "https://twitter.com/MaximeThizeau";
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

$profile_context = $first_tweet->find(".ProfileTweet-header .ProfileTweet-context", 0);
if(preg_match("#à Retweeté#", $profile_context));
echo "OK";




?>

<?php
// redirectPage($currentUrl);
?>
