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

// Requête SQL avec jointure pour récupérer les plats avec les informations des menus
$stmt = $bdd->prepare("SELECT p.*, m.name AS menu_name 
                       FROM plats p 
                       INNER JOIN menus m ON p.id_menus = m.id 
                       ORDER BY p.created_at DESC 
                       LIMIT :start, :limit");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$plats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $bdd->query("SELECT COUNT(*) FROM plats")->fetchColumn();
$pages = ceil($total / $limit);
?>



<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Liste des Plats -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Plats</h2>
        <a href="add_plat.php" class="btn btn-primary">Ajouter un Plat</a>
    </div>
    <?php if (count($plats) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Menu</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plats as $plat): ?>
                    <tr>
                        <td><?php echo $plat['id']; ?></td>
                        <td><?php echo $plat['name']; ?></td>
                        <td><?php echo $plat['description']; ?></td>
                        <td><?php echo $plat['price']; ?></td>
                        <td><img src="<?php echo $plat['image_url']; ?>" alt="<?php echo $plat['name']; ?>" width="50"></td>
                        <td><?php echo $plat['menu_name']; ?></td>
                        <td><?php echo $plat['created_at']; ?></td>
                        <td>
                            <a href="edit_plat.php?id=<?php echo $plat['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_plat.php?id=<?php echo $plat['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?');">Supprimer</a>
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
        <div class="alert alert-info">Aucun plat trouvé.</div>
    <?php endif; ?>
</section>
