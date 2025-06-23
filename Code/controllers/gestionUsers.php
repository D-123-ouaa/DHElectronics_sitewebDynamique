<?php
session_start();
if(isset($_SESSION['autorisation']) && $_SESSION['autorisation'] === "oui") {
    header('Location: gestionAfficherProduits.php');
    exit();
}
if(isset($_POST["ok"]) && isset($_POST["login"]) && isset($_POST["password"])) {

    require "../Models/utilisateur.php";
    $o1 = new Utilisateur();
    $login = $_POST["login"];
    $password = $_POST["password"];
    $user = $o1->authentification($login, $password);
    
    if($user !== null) {
        $_SESSION['login'] = $user["login"];
        $_SESSION['role'] = $user["type"];
        $_SESSION['autorisation'] = "oui";
        header('Location: gestionAfficherProduits.php');
        exit();
    } else {
        header('Location: gestionUsers.php?error=auth');
        exit();
    }
}
require "../Views/authentification.php";
?>