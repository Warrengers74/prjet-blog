<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

$req = $db->query('SELECT `id_article`, `title`, `image`, `category` FROM `articles` INNER JOIN  `categories` ON articles.id_category = categories.id_category ORDER BY `id_article` DESC');

if(isset($_SESSION['username'])) {
    // démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, 
    // n'est envoyée au navigateur, mais temporairement mise en tampon
    ob_start();
    ?>
    <div class="logout">
        <a href="logout.php">Log Out</a>
    </div>
    <div class="create">
        <a href="create.php"class="crBtn">Create article</a>
    </div>
    <?php
    // PDO::FETCH_ASSOC: transforme mon objet en tableau
    while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <article class="admin">
            <img src='<?=$article['image']?>'>
            <h2><?=$article['title']?></h2>
            <h3>Catégorie : <?=$article['category']?></h3>
            <a href="admin_suite.php?id=<?=$article['id_article']?>">En savoir plus</a>
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
