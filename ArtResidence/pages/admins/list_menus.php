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

// Requête SQL pour récupérer les menus avec pagination
$stmt = $bdd->prepare("SELECT * FROM menus ORDER BY created_at DESC LIMIT :start, :limit");
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $bdd->query("SELECT COUNT(*) FROM menus")->fetchColumn();
$pages = ceil($total / $limit);
?>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Liste des Menus -->
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Menus</h2>
        <a href="add_menu.php" class="btn btn-primary">Ajouter un Menu</a>
    </div>
    <?php if (count($menus) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?php echo $menu['id']; ?></td>
                        <td><?php echo $menu['name']; ?></td>
                        <td><?php echo $menu['description']; ?></td>
                        <td><?php echo $menu['price']; ?></td>
                        <td><img src="<?php echo $menu['image_url']; ?>" alt="<?php echo $menu['name']; ?>" width="50"></td>
                        <td><?php echo $menu['created_at']; ?></td>
                        <td>
                            <a href="edit_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?');">Supprimer</a>
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
        <div class="alert alert-info">Aucun menu trouvé.</div>
    <?php endif; ?>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
