<?php
require_once('connect.php');

if(isset($_GET['id'])) {
    $idArticle = $_GET['id'];
}

$req = $db->prepare('SELECT * FROM `articles` WHERE `id_article` = :id');
$req->bindParam('id', $idArticle, PDO::PARAM_INT);
$req->execute();

$v = $db->query("SELECT * FROM `articles`");
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
        </article>
    <?php }
} else {
    foreach($v as $article){
        ?>
            <article class="articles">
                <img src='<?=$article['image']?>'>
                <h2><?=$article['title']?></h2>
                <p><?=$article['content']?></p>
            </article>
        <?php }
}
$content = ob_get_clean();
    
require 'views/template_articles.php';
