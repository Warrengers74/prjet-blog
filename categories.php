<?php
require_once 'connect.php';

$req = $db->query('SELECT `id_category`, `category`, `image_cat` FROM `categories`');
ob_start();
?>
<h1 class="titreCategorie">Catégories :</h1>
<div class="sectionCategories">
<?php
while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
?>
    <article class="categories">
        <a href="./categories_suite.php?id=<?=$article['id_category']?>"><img src='<?=$article['image_cat']?>'></a>
        <h2><?=$article['category']?></h2>
    </article>
<?php    
}
?>
</div>
<?php
$content = ob_get_clean();
require 'views/template_categories.php';
