


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Boisson - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>


<!-- Formulaire d'ajout de boisson -->
<section class="container my-5">
    <h2>Ajouter une Boisson</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" name="price" class="form-control" id="price" required>
        </div>
        <div class="mb-3">
            <label for="id_type_boissons" class="form-label">Type de Boisson</label>
            <select name="id_type_boissons" class="form-control" id="id_type_boissons" required>
                <option value="">Sélectionner un type de boisson</option>
                <?php foreach ($types_boissons as $type): ?>
                    <option value="<?php echo $type['id']; ?>"><?php echo $type['types']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger mt-3"><?php echo $erreur; ?></div>
        <?php endif; ?>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>



<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

// Taille maximale autorisée (5 Mo)
$max_size = 5 * 1024 * 1024; // 5 Mo en octets

// Types de fichiers autorisés
$allowed_types = ['image/jpeg', 'image/png', 'image/gif']; // Types MIME autorisés

// Récupérer les types de boissons depuis la base de données
$types_boissons_stmt = $bdd->prepare("SELECT * FROM types_boissons");
$types_boissons_stmt->execute();
$types_boissons = $types_boissons_stmt->fetchAll();

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $id_type_boissons = intval($_POST['id_type_boissons']);

    // Vérification des champs requis
    if (empty($name) || empty($description) || empty($price) || empty($id_type_boissons)) {
        $erreur = "Tous les champs doivent être complétés!";
    } else {
        // Vérification de l'image
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            $image_size = $_FILES['image']['size'];
            $image_type = $_FILES['image']['type'];

            // Vérifier la taille du fichier
            if ($image_size > $max_size) {
                $erreur = "Le fichier dépasse la taille maximale autorisée (5 Mo).";
            }

            // Vérifier le type de fichier
            if (!in_array($image_type, $allowed_types)) {
                $erreur = "Seuls les fichiers de type JPG, JPEG, PNG sont autorisés.";
            }

            // Si aucune erreur, procéder au téléchargement du fichier avec un nom personnalisé
            if (empty($erreur)) {
                // Générer un nom de fichier unique basé sur l'id de la boisson et son nom
                $boisson_id = uniqid(); // Utilisation d'une fonction unique pour assurer l'unicité
                $image_url = 'uploads/' . $boisson_id . '_' . $name . '_' . basename($image_name);

                if (!move_uploaded_file($tmp_name, './' . $image_url)) {
                    $erreur = "Erreur lors du téléchargement de l'image.";
                }
            }
        } else {
            $erreur = "Erreur lors du téléchargement de l'image.";
        }

        if (empty($erreur)) {
            $stmt = $bdd->prepare("INSERT INTO boissons (name, description, price, image_url, id_types_boissons) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(array($name, $description, $price, $image_url, $id_type_boissons));

            header('Location: list_boissons.php');
            exit();
        }
    }
}
?>