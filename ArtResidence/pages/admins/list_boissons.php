<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../../clients/admin.php');
    exit();
}

include '../../traitements/config.php';

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Requête SQL avec jointure pour récupérer les boissons avec les informations des types de boissons
$stmt = $bdd->prepare("SELECT b.*, tb.types AS type_name 
                       FROM boissons b 
                       INNER JOIN types_boissons tb ON b.id_types_boissons = tb.id 
                       ORDER BY b.created_at DESC 
                       LIMIT :start, :limit");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$boissons = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $bdd->query("SELECT COUNT(*) FROM boissons")->fetchColumn();
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Boissons - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php'; ?>

<!-- Liste des Boissons -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Boissons</h2>
        <a href="add_boisson.php" class="btn btn-primary">Ajouter une Boisson</a>
    </div>
    <?php if (count($boissons) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Type de Boisson</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($boissons as $boisson): ?>
                    <tr>
                        <td><?php echo $boisson['id']; ?></td>
                        <td><?php echo $boisson['name']; ?></td>
                        <td><?php echo $boisson['description']; ?></td>
                        <td><?php echo $boisson['price']; ?></td>
                        <td><img src="<?php echo $boisson['image_url']; ?>" alt="<?php echo $boisson['name']; ?>" width="50"></td>
                        <td><?php echo $boisson['type_name']; ?></td>
                        <td><?php echo $boisson['created_at']; ?></td>
                        <td>
                            <a href="edit_boisson.php?id=<?php echo $boisson['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_boisson.php?id=<?php echo $boisson['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette boisson ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item<?php if($page == 1) echo ' disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item<?php if($page == $i) echo ' active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item<?php if($page == $pages) echo ' disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-info">Aucune boisson trouvée.</div>
    <?php endif; ?>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
