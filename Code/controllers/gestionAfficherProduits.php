<?php
session_start();

if(!isset($_SESSION['autorisation']) || $_SESSION['autorisation'] !== "oui") {
    header("Location: gestionUsers.php?error=acces");
    exit();
}

$alertScript = '';

if (isset($_GET['alert'], $_GET['message'])) {
    $alertType = $_GET['alert'];
    $message = urldecode($_GET['message']);
    
    $alertScript = "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const isSuccess = ".($alertType === 'success' ? 'true' : 'false').";
            const message = '".addslashes($message)."';
            
            // Créer une alerte personnalisée
            const alertBox = document.createElement('div');
            alertBox.style.position = 'fixed';
            alertBox.style.top = '20px';
            alertBox.style.right = '20px';
            alertBox.style.padding = '15px 20px';
            alertBox.style.borderRadius = '4px';
            alertBox.style.color = 'white';
            alertBox.style.fontWeight = 'bold';
            alertBox.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
            alertBox.style.zIndex = '10000';
            alertBox.style.opacity = '0';
            alertBox.style.transition = 'opacity 0.3s';
            
            // Appliquer la couleur en fonction du type
            if(isSuccess) {
                alertBox.style.backgroundColor = '#4CAF50'; // Vert
                alertBox.innerHTML = '✅ ' + message;
            } else {
                alertBox.style.backgroundColor = '#F44336'; // Rouge
                alertBox.innerHTML = '❌ ' + message;
            }
            
            document.body.appendChild(alertBox);
            
            // Animation d'apparition
            setTimeout(() => {
                alertBox.style.opacity = '1';
            }, 10);
            
            // Disparaître après 3 secondes
            setTimeout(() => {
                alertBox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(alertBox);
                }, 300);
            }, 3000);
        });
    </script>";
}

require '../models/produits.php';

$produitModel = new Produits();
$produits = $produitModel->getAllProduits();



$tableauHTML = '
<table class="table table-bordered table-hover align-middle">
  <thead class="table-primary text-center">
    <tr>
      <th>Référence</th>
      <th>Libellé</th>
      <th>Prix</th>
      <th>Quantité</th>
      <th>Description</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>';

if (!empty($produits)) {
  foreach ($produits as $p) {
    $actions = '<a href="gestionFicheProduit.php?ref=' . urlencode($p['RefPdt']) . '" class="btn btn-primary btn-sm" title="Afficher">
                  <i class="bi bi-eye"></i>
                </a>';
    
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') {
        $actions .= '<a href="gestionSupprimerProduits.php?ref=' . urlencode($p['RefPdt']) . '" 
                     onclick="return confirm(\'Voulez-vous vraiment supprimer ce produit ?\');" 
                     class="btn btn-danger btn-sm ms-1" title="Supprimer">
                        <i class="bi bi-trash"></i>
                    </a>';
    }
    
    $tableauHTML .= '<tr>
        <td>' . htmlspecialchars($p['RefPdt']) . '</td>
        <td>' . htmlspecialchars($p['libPdt']) . '</td>
        <td>' . htmlspecialchars($p['Prix']) . ' MAD</td>
        <td>' . htmlspecialchars($p['Qte']) . '</td>
        <td>' . htmlspecialchars($p['description']) . '</td>
        <td class="text-center">
          <img src="' . htmlspecialchars($p['image']) . '" alt="Image produit" style="max-width: 100px; max-height: 80px; object-fit: contain;">
        </td>
        <td class="text-center">' . $actions . '</td>
      </tr>';
  }
  } else {
    $tableauHTML .= '<tr><td colspan="7" class="text-center">Aucun produit trouvé</td></tr>';
  }

  $tableauHTML .= '</tbody></table>';

  $boutonAjouter = '';
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
      $boutonAjouter = '<div class="text-end mb-3">
          <a href="gestionAjouterProduits.php" class="btn btn-success">
              <i class="bi bi-plus-circle"></i> Ajouter un produit
          </a>
      </div>';
  }

  echo $alertScript;
  require '../views/accueil.php';
?>

