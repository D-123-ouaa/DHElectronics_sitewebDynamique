<?php

class Produits{

  public function connection(){
    try{
      $dbname = "projetphpbd";
      $host = "localhost";
      $password = "";
      $username = "root";

      $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      return $con;
    }catch (PDOException $e) {
      die("Erreur de connexion à la base de données : " . $e->getMessage());
      return null;
    }
  }

  public function ajouterProduits($ref, $lib, $prix, $qte, $desc, $image, $type) {
    $con = $this->connection();
    if($con != null){
      $sql = "SELECT * from produit where RefPdt = :ref";
      $stmt = $con->prepare($sql);
      $stmt->execute([':ref' => $ref]);
      if($stmt->rowCount() > 0) {
        return "<script>alert('Le produit existe déjà')</script>";
      }else{
        $sql = "INSERT INTO produit (RefPdt, libPdt, Prix, Qte, description, image, type) VALUES (:ref, :lib, :prix, :qte, :desc, :image, :type)";
        $stmt = $con->prepare($sql);
        if($stmt->execute([
          ':ref' => $ref,
          ':lib' => $lib,
          ':prix' => $prix,
          ':qte' => $qte,
          ':desc' => $desc,
          ':image' => $image,
          ':type' => $type
        ])) {
          return "<script>alert('Le produit a été ajouté avec succès')</script>";
        } else {
          return "<script>alert('Erreur lors de l\'ajout du produit')</script>";
        }
      }
    }
  }


}

?>