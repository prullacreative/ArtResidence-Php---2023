<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

// Récupérer tous les types de boissons depuis la base de données
$types_boissons = $bdd->query("SELECT * FROM types_boissons")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Types de Boissons - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Liste des Types de Boissons -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Types de Boissons</h2>
        <a href="add_type_boisson.php" class="btn btn-primary">Ajouter un Type de Boisson</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($types_boissons as $type): ?>
                <tr>
                    <td><?php echo $type['id']; ?></td>
                    <td><?php echo $type['types']; ?></td>
                    <td>
                        <a href="edit_type_boisson.php?id=<?php echo $type['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete_type_boisson.php?id=<?php echo $type['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de boisson ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
