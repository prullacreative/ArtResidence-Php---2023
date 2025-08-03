<?php
// Inclure le fichier de configuration pour se connecter à la base de données
include '../../traitements/config.php';

// Définir les informations de l'administrateur
$email = 'rollaelle@gmail.com';
$password = 'rolla';
$fullname = 'Rolla';

// Hacher le mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Préparer la requête SQL pour insérer un nouvel administrateur
    $stmt = $bdd->prepare("INSERT INTO admin (email, password, fullname) VALUES (:email, :password, :fullname)");

    // Lier les valeurs
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':fullname', $fullname);

    // Exécuter la requête
    $stmt->execute();

    echo "Nouvel administrateur ajouté avec succès";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
