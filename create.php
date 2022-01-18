<?php
session_start();

if(isset($_SESSION['username'])) {
    // démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, 
    // n'est envoyée au navigateur, mais temporairement mise en tampon
    ob_start();
    
    ?>
    <h1>Page de création d'un article</h1>
    <!-- form action ===>L'URL qui traite l'envoi du formulaire. -->
    <form action="create_db.php" method="POST" enctype="multipart/form-data">
        <div>
            <br><label for="image">Image</label><br>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <br><label for="title">Titre</label><br>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <br><label for="content">Contenu</label><br>
            <textarea name="content" id="content" cols="30" rows="20"></textarea>
        </div>
        <div>
            <br><label for="id_category">Catégorie</label><br>
            <select name="id_category">
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
        <br><input type="submit" name="submit" value="Créer">
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