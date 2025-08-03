<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

// Vérifier si l'ID du menu est présent dans l'URL
if (!isset($_GET['id'])) {
    header('Location: list_menus.php');
    exit();
}

$id = $_GET['id'];

// Supprimer le menu de la base de données
$stmt = $bdd->prepare("DELETE FROM menus WHERE id = ?");
if ($stmt->execute([$id])) {
    // Redirection vers la liste des menus après la suppression réussie
    header('Location: list_menus.php');
    exit();
} else {
    echo "Erreur lors de la suppression du menu.";
}
?>
