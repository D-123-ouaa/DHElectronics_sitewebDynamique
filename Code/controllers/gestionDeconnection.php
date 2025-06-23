<?php
session_start();

if(!isset($_SESSION['autorisation']) || $_SESSION['autorisation'] !== "oui") {
    header("Location: gestionUsers.php?error=acces");
    exit();
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}
session_destroy();
header("Location: gestionUsers.php?success=deconnexion");
exit();
?>