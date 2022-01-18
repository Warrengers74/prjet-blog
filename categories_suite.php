<?php 
require_once 'connect.php';

$idArticle = $_GET['id'];

$req = $db->prepare('SELECT * FROM `articles` INNER JOIN  `categories` ON articles.id_category = categories.id_category WHERE articles.id_category = :id');
$req->bindParam('id', $idArticle, PDO::PARAM_INT);
$req->execute();

$articles = $req->fetchAll(PDO::FETCH_ASSOC);
ob_start();
?>
<div class="sectionCategories">
<?php
foreach($articles as $article){
?>
    <div class="contenant">
        <a href="./articles.php?id=<?=$article['id_article']?>"><img src='<?=$article['image']?>'></a>
        <h2 class="texte"><?=$article['title']?></h2>
    </div>
<?php 
}
?>
</div>
<?php   
$content = ob_get_clean();
    
require 'views/template_categories.php';