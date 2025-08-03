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
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    // Gestion de l'image
    $image_url = ''; // Initialisez cette variable avec le chemin vers l'image

     // Vérification des champs requis
     if (empty($name) || empty($description) || empty($price) ) {
        $erreur = "Tous les champs doivent être complétés!";
    } else {
        // Vérification de l'image
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $image_url = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($tmp_name, './' . $image_url);
        } else {
            $erreur = "Erreur lors du téléchargement de l'image.";
        }

        if (empty($erreur)) {
            $stmt = $bdd->prepare("INSERT INTO menus (name, description, price, image_url) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$name, $description, $price, $image_url])) {
                // Redirection vers la liste des menus après l'ajout réussi
                header('Location: list_menus.php');
                exit();
            } else {
                $erreur = "Erreur lors de l'ajout du menu.";
            }
        }
    }

    // Insertion dans la base de données
  
}
?>


<!-- Barre de Navigation -->
<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Formulaire d'Ajout de Menu -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ajouter un Menu</h2>
        <a href="list_menus.php" class="btn btn-secondary">Retour à la Liste des Menus</a>
    </div>
    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du Menu</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
