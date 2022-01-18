<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

// démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, 
// n'est envoyée au navigateur, mais temporairement mise en tampon
ob_start();
?>
<h1>Page de connexion</h1>

<?php if(isset($_SESSION['username'])){
    header('location: /projet-blog/admin');
} else {
?>    
    <!-- form action ===>L'URL qui traite l'envoi du formulaire. -->
    <form action="login_verif.php" method="POST">
        <br><label>Identifiant</label><br>
        <input type="text" name="username" placeholder="Nom d'utilisateur">
        <br><label>Mot de passe</label><br>
        <input type="password" name="password" placeholder="Mot de passe">
        <br><br><input type="submit" value="Login" name="submit">
    </form>
<?php }
// Lit le contenu courant du tampon de sortie puis l'éfface + le contenu ci-dessus et contenue dans la variable $content
$content= ob_get_clean();
// je veux le fichier 'template.php'
require 'views/template_admin.php';
?>