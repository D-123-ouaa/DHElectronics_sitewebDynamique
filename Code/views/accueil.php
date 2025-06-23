<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>DHElectronics - Liste des Produits</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../views/headerFooter.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
</style>
<?php if (!empty($alertScript)) echo $alertScript; ?>
</head>
<body>

  
  <header class="site-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
            <h1 class="logo">DHElectronics</h1>
            <div>
                <?php if(isset($_SESSION['autorisation']) && $_SESSION['autorisation'] === "oui"): ?>
                    <div class="user-info text-white">
                        <?php if ($_SESSION['role'] === 'administrateur'): ?>
                            <span class="badge bg-danger ms-2">Administrateur</span>
                        <?php else: ?>
                            <span class="badge bg-info ms-2">Utilisateur</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
      <nav class="navbar">
        <a href="../controllers/gestionAfficherProduits.php">Accueil</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur'): ?>
          <a href="../controllers/gestionAjouterProduits.php">Ajouter</a>
        <?php endif; ?>
        <?php if(isset($_SESSION['autorisation']) && $_SESSION['autorisation'] === "oui"): ?>
          <a href="../controllers/gestionDeconnection.php">Déconnexion</a>
        <?php else: ?>
          <a href="../controllers/gestionUsers.php">Connexion</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>


  <main class="container mt-4">
    <h2 class="mb-4 text-center">Liste des Produits</h2>
    <div id="produit-table">
      <?= $tableauHTML ?>
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 DHElectronics. Tous droits réservés.</p>
      <p>Projet développé dans le cadre du module M107 - Sites Web Dynamiques.</p>
    </div>
  </footer>

</body>
</html>