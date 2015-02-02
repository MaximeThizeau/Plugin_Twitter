<?php
set_time_limit(0);
include('plugins/simple_html_dom.php');

$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<?php


  // S'il y a un problème avec l'URL que l'on crawl, on passe à la suivante et on met à jour en disant qu'on la faîte.
  if (file_get_html($donnees['url']) == false OR file_get_contents($donnees['url']) == false){
    updateUrlDoneTest($donnees['id'], $bdd);
    continue;
  }




  echo "<h2>Url crawled : ". $donnees['url'].'</h2>' ;

  // On récupère le contenu de la page que l'on crawl.
  $html = file_get_html($donnees['url']);





?>
<p>Ajout des tests fini</p>

<?php
 redirectPage($currentUrl);
?>
