<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

// Vérifier si l'ID du type de boisson est présent dans l'URL
if (!isset($_GET['id'])) {
    header('Location: list_types_boissons.php');
    exit();
}

$id = $_GET['id'];

// Supprimer le type de boisson de la base de données
$stmt = $bdd->prepare("DELETE FROM types_boissons WHERE id = ?");
if ($stmt->execute([$id])) {
    // Redirection vers la liste des types de boissons après la suppression réussie
    header('Location: list_types_boissons.php');
    exit();
} else {
    echo "Erreur lors de la suppression du type de boisson.";
}
?>
