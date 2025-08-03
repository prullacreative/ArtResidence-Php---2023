<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

// Vérifier si l'ID du menu est présent dans l'URL
if (!isset($_GET['id'])) {
    header('Location: list_menus.php');
    exit();
}

$id = $_GET['id'];

// Récupérer les détails du menu à modifier
$stmt = $bdd->prepare("SELECT * FROM menus WHERE id = ?");
$stmt->execute([$id]);
$menu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    // Rediriger si le menu n'est pas trouvé
    header('Location: list_menus.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    // Gestion de l'image - à implémenter si nécessaire
    $image_url = ''; // Initialisez cette variable avec le chemin vers l'image

    // Mettre à jour le menu dans la base de données
    $stmt = $bdd->prepare("UPDATE menus SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
    if ($stmt->execute([$name, $description, $price, $image_url, $id])) {
        // Redirection vers la liste des menus après la modification réussie
        header('Location: list_menus.php');
        exit();
    } else {
        $erreur = "Erreur lors de la modification du menu.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Menu - <?php echo $menu['name']; ?> - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>


<!-- Formulaire de Modification de Menu -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Modifier Menu - <?php echo $menu['name']; ?></h2>
        <a href="list_menus.php" class="btn btn-secondary">Retour à la Liste des Menus</a>
    </div>
    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du Menu</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $menu['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $menu['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $menu['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
