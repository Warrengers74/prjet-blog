<?php
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

if(isset($_POST['submit'])){
    
    $path = './img/';
    $arrayType = ["jpg" => 'image/jpg', "jpeg" => 'image/jpeg'];
    $name = basename($_FILES['image']['name']);
    
    if(in_array($_FILES['image']['type'], $arrayType)){
        move_uploaded_file($_FILES['image']['tmp_name'], $path.$name);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = './img/'.$name;
        $cat = $_POST['id_category'];
        $author = $_POST['id_user'];
        // je fais une requete dans ma base de donnée
        $req = $db->query("INSERT INTO `articles` (`title`, `content`, `image`, `id_category`, `id_user`) VALUE ('$title', '$content', '$img', '$cat', '$author')");
        
        //  renvoi à la page admin.php une fois la requête effectuée
        header('location: /projet-blog/admin');
    } else {
        echo "Le format de l'image n'est pas le bon";
    }
}



