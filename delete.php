<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

if(isset($_SESSION['username'])) {
    $id = $_GET['id'];
    
    // je fais une requete dans ma base de donnée
    $req = $db->query("DELETE  FROM `articles` WHERE `id_article` = '$id'");
    
    header('location: /projet-blog/admin');
} else {
    echo 'Vous n\'êtes pas connecté. <a href="login.php">Cliquez ici</a> pour vous connectez.';
}
?>