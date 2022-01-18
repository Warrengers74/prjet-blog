<?php
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

if(isset($_POST['submit'])){
    
    $path = './img/';
    $arrayType = ["jpg" => 'image/jpg', "jpeg" => 'image/jpeg'];
    $name = basename($_FILES['image']['name']);
    
    if(in_array($_FILES['image']['type'], $arrayType)){
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$name);
        $id = $_POST['id_article'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = './img/'.$name;
        $cat = $_POST['id_category'];
    
        // je fais une requete dans ma base de donnée
        $req = $db->query("UPDATE `articles` SET `title` = '$title', `content` = '$content', `image` = '$img', `id_category` = '$cat' WHERE `id_article` = '$id'");
    
        //  renvoi à la page admin.php une fois la requête effectuée
        header('location: /projet-blog/admin');
    } else {
        echo "Le format de l'image n'est pas le bon";
    }
}