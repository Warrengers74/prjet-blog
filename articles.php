<?php
require_once('connect.php');

if(isset($_GET['id'])) {
    $idArticle = $_GET['id'];
}

$req = $db->prepare('SELECT `id_article`, `title`, `image`, `content`, `category`, categories.id_category FROM `articles` INNER JOIN  `categories` ON articles.id_category = categories.id_category WHERE articles.id_article = :id');
$req->bindParam('id', $idArticle, PDO::PARAM_INT);
$req->execute();

$v = $db->query("SELECT `id_article`, `title`, `image`, `content`, `category`, categories.id_category FROM `articles` INNER JOIN  `categories` ON articles.id_category = categories.id_category");
$v = $v->fetchAll(PDO::FETCH_ASSOC);


$articles = $req->fetchAll(PDO::FETCH_ASSOC);
ob_start();
if(isset($_GET['id'])) {
    foreach($articles as $article){
    ?>
        <article class="articles">
            <img src='<?=$article['image']?>'>
            <h2><?=$article['title']?></h2>
            <p><?=$article['content']?></p>
            <h3>Catégorie : <a href="./categories_suite.php?id=<?=$article['id_category']?>"><?=$article['category']?></a></h3>
        </article>
    <?php }
} else {
    foreach($v as $article){
        ?>
            <article class="articles">
                <img src='<?=$article['image']?>'>
                <h2><?=$article['title']?></h2>
                <p><?=$article['content']?></p>
                <h3>Catégorie : <a href="./categories_suite.php?id=<?=$article['id_category']?>"><?=$article['category']?></a></h3>
            </article>
        <?php }
}
$content = ob_get_clean();
    
require 'views/template_articles.php';
