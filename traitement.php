<?php
session_start();

try {
    $bddPDO = new PDO('mysql:host=localhost;dbname=serre', 'root', '');
    $bddPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['btn'])) {
    $mail = $_POST['user'];
    $pass = $_POST['password'];

    $requete = $bddPDO->prepare('SELECT * FROM staff WHERE user=:user AND password=:password');
    $requete->execute(array('user' => $mail, 'password' => $pass));
    $result = $requete->fetch();

    if ($result) {
        $_SESSION["user"] = $result['user'];
        header('location:DashboardClient.html');
        exit;
    } else {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
