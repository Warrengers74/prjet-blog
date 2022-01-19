<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

$id = $_GET['id'];

// je fais une requete dans ma base de donnée
$req = $db->query('SELECT `id_article`, `image`, `title`, `content`, `id_category`, `id_user` FROM `articles` WHERE `id_article` = '. $id);

// PDO::FETCH_ASSOC: transforme mon objet en tableau
$post = $req->fetch(PDO::FETCH_ASSOC);

if(isset($_SESSION['username'])) {
    // démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, 
    // n'est envoyée au navigateur, mais temporairement mise en tampon
    ob_start();
    ?>
    <h1>Page de mis à jour d'un article</h1>
    <!-- form action ===>L'URL qui traite l'envoi du formulaire. -->
    <form action="update_db.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_article" id="id_article" value="<?= $post['id_article'] ?>">
        <div>
            <br><label for="image">Image</label><br>
            <input type="file" name="image" id="image" value="<?= $post['image'] ?>">
        </div>
        <div>
            <br><label for="title">Titre</label><br>
            <input type="text" name="title" id="title" value="<?= $post['title'] ?>">
        </div>
        <div>
           <br> <label for="content">Contenu</label><br>
            <textarea name="content" id="content" cols="30" rows="20"><?= $post['content'] ?></textarea>
        </div>
        <div>
            <br><label for="id_category">Catégorie</label><br>
            <select name="id_category" value="<?= $post['id_category'] ?>">
                <option value="1">Europe</option>
                <option value="2">Afrique</option>
                <option value="3">Amérique</option>
                <option value="4">Asie</option>
                <option value="5">Océanie</option>
            </select>
        </div>  
        <div>
            <br><label for="id_user">Auteur</label><br>
            <select name="id_user">
                <option value="<?= $_SESSION['id_user']?>"><?=$_SESSION['username']?></option>
            </select>
        </div> 
        <br><input type="submit" name="submit" value="Mettre à jour">
    </form>
    <?php 
    
    // Lit le contenu courant du tampon de sortie puis l'éfface + le contenu ci-dessus et contenue dans la variable $content
    $content= ob_get_clean();
    // je veux le fichier 'template.php'
    require 'views/template_admin.php';
} else {
    echo 'Vous n\'êtes pas connecté. <a href="login.php">Cliquez ici</a> pour vous connectez.';
}
?>