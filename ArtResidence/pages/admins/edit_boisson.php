<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

// Récupérer les types de boissons existants
$types_boissons = $bdd->query("SELECT * FROM types_boissons")->fetchAll();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("SELECT * FROM boissons WHERE id = ?");
    $stmt->execute(array($id));
    $boisson = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $id_types_boissons = intval($_POST['id_types_boissons']);

        // Vérification des champs requis
        if (empty($name) || empty($description) || empty($price) || empty($id_types_boissons)) {
            $erreur = "Tous les champs doivent être complétés!";
        } else {
            // Traitement de l'image si une nouvelle image est téléchargée
             // Vérification de l'image
                if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $image_url = 'uploads/' . basename($_FILES['image']['name']);
                    move_uploaded_file($tmp_name, './' . $image_url);
                } else {
                    $erreur = "Erreur lors du téléchargement de l'image.";
                }

            if (empty($erreur)) {
                $stmt = $bdd->prepare("UPDATE boissons SET name = ?, description = ?, price = ?, image_url = ?, id_types_boissons = ? WHERE id = ?");
                $stmt->execute(array($name, $description, $price, $image_url, $id_types_boissons, $id));

                header('Location: list_boissons.php');
                exit();
            }
        }
    }
} else {
    header('Location: list_boissons.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Boisson - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Formulaire de modification de boisson -->
<section class="container my-5">
    <h2>Modifier une Boisson</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($boisson['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" required><?php echo htmlspecialchars($boisson['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($boisson['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_types_boissons" class="form-label">Type de Boisson</label>
            <select name="id_types_boissons" class="form-control" id="id_types_boissons" required>
                <option value="">Sélectionnez un type</option>
                <?php foreach ($types_boissons as $type): ?>
                    <option value="<?php echo $type['id']; ?>" <?php echo $boisson['id_types_boissons'] == $type['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($type['types']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
            <small>Image actuelle : <a href="../../<?php echo htmlspecialchars($boisson['image_url']); ?>" target="_blank"><?php echo htmlspecialchars($boisson['image_url']); ?></a></small>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger mt-3"><?php echo $erreur; ?></div>
        <?php endif; ?>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
