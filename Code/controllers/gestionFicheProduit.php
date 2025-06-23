<?php
session_start(); 

if(!isset($_SESSION['autorisation']) || $_SESSION['autorisation'] !== "oui") {
    header("Location: gestionUsers.php?error=acces");
    exit();
}

require_once '../models/produits.php';

$contenuFiche = '';
$produit = null;

if (isset($_GET['ref'])) {
    $ref = $_GET['ref'];
    $model = new Produits();
    $produit = $model->getProduitParRef($ref);

   if ($produit) {
    $actions = '<a href="gestionAfficherProduits.php" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>';
    
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') {
        $actions .= '<div class="btn-group ms-2">
                        <a href="gestionSupprimerProduits.php?ref=' . urlencode($produit['RefPdt']) . '" 
                           class="btn btn-danger"
                           onclick="return confirm(\'Voulez-vous vraiment supprimer ce produit ?\');">
                            <i class="bi bi-trash"></i> Supprimer
                        </a>
                    </div>';
    }
    
    $contenuFiche = '
    <div class="card border-0 shadow-lg mb-5">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-center">Fiche produit : ' . htmlspecialchars($produit['libPdt']) . '</h2>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="bg-light p-3 border rounded shadow-sm" style="max-width: 100%;">
                        <img src="' . htmlspecialchars($produit['image']) . '" 
                             alt="' . htmlspecialchars($produit['libPdt']) . '" 
                             class="img-fluid" 
                             style="max-height: 350px; object-fit: contain;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr class="table-light"><th class="w-25">Référence</th><td>' . htmlspecialchars($produit['RefPdt']) . '</td></tr>
                                <tr><th>Libellé</th><td>' . htmlspecialchars($produit['libPdt']) . '</td></tr>
                                <tr class="table-light"><th>Prix</th><td><span class="fs-6">' . htmlspecialchars($produit['Prix']) . ' MAD</span></td></tr>
                                <tr><th>Quantité</th><td><span class="text-dark fs-6">' . htmlspecialchars($produit['Qte']) . ' unités</span></td></tr>
                                <tr class="table-light"><th>Description</th><td>' . htmlspecialchars($produit['description']) . '</td></tr>
                                <tr><th>Type</th><td>' . htmlspecialchars($produit['type']) . '</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                ' . $actions . '
            </div>
        </div>
    </div>';
} else {
        $contenuFiche = '
        <div class="alert alert-warning text-center p-4 shadow">
            <i class="bi bi-exclamation-triangle fs-1"></i>
            <h3 class="mt-3">Produit non trouvé</h3>
            <p class="mb-0">La référence demandée n\'existe pas dans notre catalogue</p>
            <a href="gestionAfficherProduits.php" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>';
    }
} else {
    $contenuFiche = '
    <div class="alert alert-warning text-center p-4 shadow">
        <i class="bi bi-exclamation-circle fs-1"></i>
        <h3 class="mt-3">Référence manquante</h3>
        <p class="mb-0">Aucune référence produit n\'a été spécifiée</p>
        <a href="gestionAfficherProduits.php" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>';
}

require_once '../views/FicheProduit.php';
?>