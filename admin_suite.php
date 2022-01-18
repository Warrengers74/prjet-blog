<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

$idArticle = $_GET['id'];

$req = $db->prepare('SELECT * FROM `articles` INNER JOIN  `categories` ON articles.id_category = categories.id_category 
                    INNER JOIN  `users` ON articles.id_user = users.id_user 
                    WHERE articles.id_article = :id');
$req->bindParam('id', $idArticle, PDO::PARAM_INT);
$req->execute();

$articles = $req->fetchAll(PDO::FETCH_ASSOC);

if(isset($_SESSION['username'])) {
    // démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, 
    // n'est envoyée au navigateur, mais temporairement mise en tampon
    ob_start();
    // PDO::FETCH_ASSOC: transforme mon objet en tableau
    foreach($articles as $article) {
        ?>
        <article>
            <img src='<?=$article['image']?>'>
            <h2><?=$article['title']?></h2>
            <p><?=$article['content']?></p>
            <h3>Catégorie : <?=$article['category']?></h3>
            <h4>Auteur : <?=$article['username']?></h4>
            <div class="btns">
                <a href="update.php?id=<?=$article['id_article']?>"class="upBtn">Update</a>
                <a href="delete.php?id=<?=$article['id_article']?>"class="delBtn">Delete</a>
            </div>
        </article>
    <?php    
    }
    
    // Lit le contenu courant du tampon de sortie puis l'éfface + le contenu ci-dessus et contenue dans la variable $content
    $content = ob_get_clean();
    // je veux le fichier 'template.php'
    require 'views/template_admin.php';
} else {
    echo 'Vous n\'êtes pas connecté. <a href="login.php">Cliquez ici</a> pour vous connectez.';
}   ?>
