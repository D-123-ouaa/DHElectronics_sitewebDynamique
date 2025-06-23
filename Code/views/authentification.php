<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DHElectronics</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../views/headerFooter.css">
  <script>
// Fonction pour afficher une alerte personnalisée
function showCustomAlert(message, isSuccess) {
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
}

// Vérifier les erreurs au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Gestion des erreurs d'authentification
    if(urlParams.has('error')) {
        if(urlParams.get('error') === 'auth') {
            showCustomAlert('Login ou mot de passe incorrect !', false);
        } else if(urlParams.get('error') === 'acces') {
            showCustomAlert('Accès non autorisé. Veuillez vous connecter.', false);
        }
        
        // Nettoyer l'URL après affichage
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});

// Fonction existante pour afficher/masquer le mot de passe
function togglePassword() {
    const passInput = document.getElementById("password");
    passInput.type = passInput.type === "password" ? "text" : "password";
}
</script>
</head>
<body>
  

<div class="">
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
  <section class="bg-white p-5 rounded shadow mx-auto mt-5" style="max-width: 500px;">
  <h2 class="mb-4 text-center text-primary">Connexion</h2>
  
  <form action="" method="post">
    <div class="mb-3 text-start">
      <label for="login" class="form-label">Login</label>
      <input type="login" name="login" id="login" class="form-control" required placeholder="Entrez votre login">
    </div>

    <div class="mb-3 text-start">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" name="password" id="password" class="form-control" required placeholder="Entrez votre mot de passe">
    </div>

    <div class="form-check mb-3 text-start">
      <input type="checkbox" class="form-check-input" id="check" onclick="togglePassword()">
      <label class="form-check-label" for="check">Afficher le mot de passe</label>
    </div>

    <button type="submit" name="ok" class="btn btn-primary w-100">Se connecter</button>
  </form>

  <div class="text-center mt-3">
    Vous n'avez pas de compte ? <a href="register.php">Créer un compte</a>
  </div>
</section>
  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 DHElectronics. Tous droits réservés.</p>
      <p>Projet développé dans le cadre du module M107 - Sites Web Dynamiques.</p>
    </div>
  </footer>
  <script>
    function togglePassword() {
      const passInput = document.getElementById("password");
      passInput.type = passInput.type === "password" ? "text" : "password";
    }
  </script>
</div>
</body>
</html>