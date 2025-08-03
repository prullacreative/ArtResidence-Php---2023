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

$total = $bdd->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
$pages = ceil($total / $limit);

$reservations = $bdd->query("SELECT * FROM reservations ORDER BY created_at DESC LIMIT $start, $limit")
  ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations - ArtResidence</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<?php include 'nav.php' ?>

<!-- Liste des Réservations -->
<section class="container my-5">
    <h2>Liste des Réservations</h2>
    <?php if (count($reservations) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>clients</th>
                    <th>tel</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nombre de Convives</th>
                    <th>Demandes Spéciales</th>
                    <th>Date de Création</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $reservation['id']; ?></td>
                        <td><?php echo $reservation['fullname']; ?></td>
                        <td><?php echo $reservation['tel']; ?></td>
                        <td><?php echo $reservation['date']; ?></td>
                       
                        <td><?php echo $reservation['time']; ?></td>
                        <td><?php echo $reservation['nbres_personnes']; ?></td>
                        <td><?php echo $reservation['demandes']; ?></td>
                        <td><?php echo $reservation['created_at']; ?></td>
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
        <div class="alert alert-info">Aucune réservation trouvée.</div>
    <?php endif; ?>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
