<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $type = htmlspecialchars($_POST['type']);

    // Insérer le nouveau type de boisson dans la base de données
    $stmt = $bdd->prepare("INSERT INTO types_boissons (types) VALUES (?)");
    if ($stmt->execute([$type])) {
        // Redirection vers la liste des types de boissons après l'ajout réussi
        header('Location: list_types_boissons.php');
        exit();
    } else {
        $erreur = "Erreur lors de l'ajout du type de boisson.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Type de Boisson - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Formulaire d'Ajout de Type de Boisson -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ajouter un Type de Boisson</h2>
        <a href="list_types_boissons.php" class="btn btn-secondary">Retour à la Liste des Types de Boissons</a>
    </div>
    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="type" class="form-label">Type de Boisson</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
