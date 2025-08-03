<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

// Vérifier si l'ID du type de boisson est présent dans l'URL
if (!isset($_GET['id'])) {
    header('Location: list_types_boissons.php');
    exit();
}

$id = $_GET['id'];

// Récupérer les détails du type de boisson à modifier
$stmt = $bdd->prepare("SELECT * FROM types_boissons WHERE id = ?");
$stmt->execute([$id]);
$type_boisson = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$type_boisson) {
    // Rediriger si le type de boisson n'est pas trouvé
    header('Location: list_types_boissons.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $type = htmlspecialchars($_POST['type']);

    // Mettre à jour le type de boisson dans la base de données
    $stmt = $bdd->prepare("UPDATE types_boissons SET types = ? WHERE id = ?");
    if ($stmt->execute([$type, $id])) {
        // Redirection vers la liste des types de boissons après la modification réussie
        header('Location: list_types_boissons.php');
        exit();
    } else {
        $erreur = "Erreur lors de la modification du type de boisson.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Type de Boisson - <?php echo $type_boisson['types']; ?> - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Formulaire de Modification de Type de Boisson -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Modifier Type de Boisson - <?php echo $type_boisson['types']; ?></h2>
        <a href="list_types_boissons.php" class="btn btn-secondary">Retour à la Liste des Types de Boissons</a>
    </div>
    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="type" class="form-label">Type de Boisson</label>
            <input type="text" class="form-control" id="type" name="type" value="<?php echo $type_boisson['types']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
