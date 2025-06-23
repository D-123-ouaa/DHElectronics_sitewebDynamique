<?php
session_start();

if (!isset($_SESSION['autorisation']) || $_SESSION['autorisation'] !== "oui" || 
    !isset($_SESSION['role']) || $_SESSION['role'] !== 'administrateur') {
    header("Location: gestionAfficherProduits.php?alert=error&message=Accès%20non%20autorisé");
    exit();
}


if(isset($_GET['ref'])) {
    $ref = $_GET['ref'];
    require '../models/produits.php';
    $o1 = new Produits();
    
    if($o1->SupprimerProduit($ref)) {
        header("Location: gestionAfficherProduits.php?alert=success&message=Produit%20supprimé%20avec%20succès");
    } else {
        header("Location: gestionAfficherProduits.php?alert=danger&message=Erreur%20lors%20de%20la%20suppression%20du%20produit");
    }
    exit();
} else {
    header("Location: gestionAfficherProduits.php?alert=danger&message=Erreur%20lors%20de%20la%20suppression%20du%20produit");
    exit();
}
?>