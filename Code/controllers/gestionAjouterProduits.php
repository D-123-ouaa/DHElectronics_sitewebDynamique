<?php
session_start();

if (!isset($_SESSION['autorisation']) || $_SESSION['autorisation'] !== "oui" || 
    !isset($_SESSION['role']) || $_SESSION['role'] !== 'administrateur') {
    header("Location: gestionAfficherProduits.php?alert=error&message=Accès%20non%20autorisé");
    exit();
}

require "../views/ajouter.php";

if(isset($_POST['ajouter']) && isset($_POST['ref']) && isset($_POST['lib']) && isset($_POST['prix']) && isset($_POST['qte']) && isset($_POST['desc']) && isset($_FILES['image']) && isset($_POST['type'])) {

    $ref = $_POST['ref'];
    $lib = $_POST['lib'];
    $prix = $_POST['prix'];
    $qte = $_POST['qte'];
    $desc = $_POST['desc'];
    $image = $_FILES['image']['name'];
    $type = $_POST['type'];

    require "../models/produits.php";
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $upload_dir = "../images/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $target_path = $upload_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $target_path)) {
      $produit = new Produits();
      $result = $produit->ajouterProduits($ref, $lib, $prix, $qte, $desc, $target_path, $type);
      echo $result;
    }else {
      echo "<script>alert('Erreur lors de l\'upload de l\'image');</script>";
    }
}


?>