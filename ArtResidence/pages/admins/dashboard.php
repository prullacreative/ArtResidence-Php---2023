<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtResidence - Tableau de Bord Administratif</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barre de Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">ArtResidence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/reservation.php">Réservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/admin.php">Connexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tableau de Bord Administratif -->
<section class="container my-5">
    <h2>Tableau de Bord Administratif</h2>
    <div class="row">
        <div class="col-md-6">
            <h3>Réservations Actuelles</h3>
            <ul class="list-group">
                <li class="list-group-item">Réservation 1</li>
                <li class="list-group-item">Réservation 2</li>
                <!-- Ajoutez d'autres réservations ici -->
            </ul>
            <button type="button" class="btn btn-success mt-3">Ajouter Réservation</button>
        </div>
        <div class="col-md-6">
            <h3>Gestion des Menus</h3>
            <ul class="list-group">
                <li class="list-group-item">Plat 1</li>
                <li class="list-group-item">Plat 2</li>
                <!-- Ajoutez d'autres plats ici -->
            </ul>
            <button type="button" class="btn btn-primary mt-3">Ajouter Plat</button>
        </div>
    </div>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
