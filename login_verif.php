<?php
session_start();
// je veux le fichier 'connect.php' pour me connecter à la base de donnée
require_once 'connect.php';

// echo password_hash('password', PASSWORD_BCRYPT); 
// ---> fonction pour hasher mon mdp 'password'
// identifiant : warren mdp : password

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    
    // je fais une requete dans ma base de donnée
    $req = $db->prepare("SELECT `username`, `password`, `id_user` FROM `users` WHERE `username`= :id");
    $req->bindParam('id', $username, PDO::PARAM_STR);
    $req->execute();
    // PDO::FETCH_ASSOC: transforme mon objet en tableau
    $dataUser = $req->fetch(PDO::FETCH_ASSOC);
    
    if(($req->rowCount()) === 1) {
        // password_verify --> fonction pour comparer le mdp que l'utilisateur entre et le mdp hasher de la base de donnée
         if (password_verify($pass, $dataUser['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $dataUser['id_user'];
            header('location: /projet-blog/admin');
         } else {
             echo 'Identifiant ou mot de passe incorrect';
         }
    } else {
        echo 'Identifiant ou mot de passe incorrect';
    }
}