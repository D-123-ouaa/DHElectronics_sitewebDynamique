<?php
class Utilisateur {
    public function connection() {
        try {
            $dbname = "projetphpbd";
            $host = "localhost";
            $password = "";
            $username = "root";

            $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            error_log("Erreur de connexion : " . $e->getMessage());
            return null;
        }
    }

    public function authentification($login, $password) {
    $con = $this->connection();
    if($con != null) {
        try {
            $sql = "SELECT * FROM utilisateur WHERE login = :loginn";
            $stmt = $con->prepare($sql);
            $stmt->execute([':loginn' => $login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user && $user['password'] === $password) {
                return $user;
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erreur d'authentification : " . $e->getMessage());
            return null;
        }
    }
    return null;
}
}
?>