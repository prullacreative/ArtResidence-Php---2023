<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

$erreur = '';

// Récupérer les menus depuis la base de données
$stmt = $bdd->prepare("SELECT id, name FROM menus");
$stmt->execute();
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $bdd->prepare("SELECT * FROM plats WHERE id = ?");
    $stmt->execute(array($id));
    $plat = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        $id_menus = intval($_POST['id_menus']);

        // Vérification des champs requis
        if (empty($name) || empty($description) || empty($price) || empty($id_menus)) {
            $erreur = "Tous les champs doivent être complétés!";
        } else {
            // Traitement de l'image si une nouvelle image est téléchargée
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['image']['tmp_name'];
                $image_url = 'uploads/' . basename($_FILES['image']['name']);
                move_uploaded_file($tmp_name, '../../' . $image_url);
            } else {
                // Si aucune nouvelle image n'est téléchargée, garder l'image existante
                $image_url = $plat['image_url'];
            }

            if (empty($erreur)) {
                $stmt = $bdd->prepare("UPDATE plats SET name = ?, description = ?, price = ?, image_url = ?, id_menus = ? WHERE id = ?");
                $stmt->execute(array($name, $description, $price, $image_url, $id_menus, $id));

                header('Location: list_plats.php');
                exit();
            }
        }
    }
} else {
    header('Location: list_plats.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Plat - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>


<!-- Formulaire de modification de plat -->
<section class="container my-5">
    <h2>Modifier un Plat</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($plat['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" required><?php echo htmlspecialchars($plat['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($plat['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_menus" class="form-label">Menu</label>
            <select name="id_menus" class="form-control" id="id_menus" required>
                <option value="">Sélectionnez un menu</option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?php echo $menu['id']; ?>" <?php echo ($plat['id_menus'] == $menu['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($menu['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image Actuelle</label><br>
            <img src="<?php echo htmlspecialchars($plat['image_url']); ?>" alt="<?php echo htmlspecialchars($plat['name']); ?>" width="100">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Nouvelle Image</label>
            <input type="file" name="image" class="form-control" id="image">
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
