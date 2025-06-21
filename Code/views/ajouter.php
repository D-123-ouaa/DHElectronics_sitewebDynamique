<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DHElectronics</title>
  <link rel="icon" href="../images/logoChat.png" type="image/icon" style="border-radius:50% ;">
  <link rel="stylesheet" href="../views/headerFooter.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="">
  <header class="site-header">
    <div class="container">
      <h1 class="logo">DHElectronics</h1>
      <nav class="navbar">
        <a href="index.php">Accueil</a>
        <a href="ajouter_produit.php">Ajouter</a>
        <a href="login.php">Connexion</a>
      </nav>
    </div>
  </header>
  <section>
  <h3 class="mb-4 text-center">L'administrateur peut ajouter un produit ici</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="ref" class="form-label">Référence du produit</label>
      <input type="text" class="form-control" id="ref" name="ref" required placeholder="Entrez la référence du produit">
    </div>
    <div class="mb-3">
      <label for="lib" class="form-label">Libellé du produit</label>
      <input type="text" class="form-control" id="lib" name="lib" required placeholder="Entrez le libellé du produit">
    </div>
    <div class="mb-3">
      <label for="prix" class="form-label">Prix du produit</label>
      <input type="text" class="form-control" id="prix" name="prix" required placeholder="Entrez le prix du produit">
    </div>
    <div class="mb-3">
      <label for="qte" class="form-label">Quantité du produit</label>
      <input type="number" class="form-control" id="qte" name="qte" required placeholder="Entrez la quantité du produit">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Description du produit</label>
      <textarea class="form-control" id="desc" name="desc" rows="3" required placeholder="Entrez la description du produit"></textarea>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Image du produit</label>
      <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type du produit</label>
      <input type="text" class="form-control" id="type" name="type" required placeholder="Entrez le type du produit">
    </div>
    <button type="submit" class="btn btn-primary" name="ajouter">Ajouter le produit</button>
    <button type="reset" class="btn btn-secondary ms-2">Réinitialiser</button>
  </form>
</section>
  <footer class="site-footer">
    <div class="container">
      <p>&copy; 2025 DHElectronics. Tous droits réservés.</p>
      <p>Projet développé dans le cadre du module M107 - Sites Web Dynamiques.</p>
    </div>
  </footer>
</div>
  
</body>
</html>