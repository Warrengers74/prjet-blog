<?php
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
// On se connecte à là base de données
require_once('connect.php');

// On détermine le nombre total d'articles
$sql = 'SELECT COUNT(`id_article`) AS nb_articles FROM `articles`;';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute
$query->execute();

// On récupère le nombre d'articles
$result = $query->fetch();

$nbArticles = (int) $result['nb_articles'];

// On détermine le nombre d'articles par page
$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT `id_article`, `title`, `image` FROM `articles` ORDER BY `id_article` DESC LIMIT :premier, :parpage;';

// On prépare la requête
$query = $db->prepare($sql);

$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

// On exécute
$query->execute();

// On récupère les valeurs dans un tableau associatif
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

ob_start();
foreach($articles as $article){
?>
    <div class="contenant">
        <a href="./articles.php?id=<?=$article['id_article']?>"><img src='<?=$article['image']?>'></a>
        <h2 class="texte"><?=$article['title']?></h2>
    </div>
<?php }
$content = ob_get_clean();
    
require 'views/template_accueil.php';