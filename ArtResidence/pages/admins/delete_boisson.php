<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("DELETE FROM boissons WHERE id = ?");
    $stmt->execute(array($id));

    header('Location: list_boissons.php');
    exit();
} else {
    header('Location: list_boissons.php');
    exit();
}
?>
