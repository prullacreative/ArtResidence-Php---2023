<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtResidence - Accueil</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        header {
            background-image: url('../assets/images/restaurant.jpg'); /* Replace with an actual URL from Pexels */
            background-size: cover;
            background-position: center;
            height: 60vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        header h1 {
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        header p {
            font-size: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }
        .search-bar {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
        }
        .search-bar input {
            border: none;
            padding: 0.5rem;
            border-radius: 20px;
            width: calc(100% - 40px);
            margin-right: -4px;
        }
        .search-bar button {
            border: none;
            background: transparent;
            color: white;
            font-size: 1.2rem;
        }
        .quick-reservation {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .image-card img {
            width: 100%;
            border-radius: 10px;
        }
        .opening-hours p {
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        .opening-hours i {
            margin-right: 10px;
            color: #007bff;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
        }
        footer a {
            color: white;
        }
        footer a:hover {
            text-decoration: none;
        }
        .navbar {
            background-color: #f8f9fa !important;
        }
        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<!-- Barre de Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ArtResidence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clients/reservation.php"><i class="fas fa-calendar-alt"></i> Réservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clients/menu.php"><i class="fas fa-utensils"></i> Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clients/admin.php"><i class="fas fa-user"></i> Connexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Section En-tête -->
<header>
    <h1>Bienvenue à ArtResidence</h1>
    <p>Une expérience culinaire unique à Porto-Novo</p>
    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
        <button type="button"><i class="fas fa-search"></i></button>
    </div>
</header>

<!-- Section Images et Informations -->
<section class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card image-card">
                <img src="../assets/images/restaurant.jpg" alt="Restaurant Image 1">
                <div class="card-body">
                    <h5 class="card-title">Ambiance Chic</h5>
                    <p class="card-text">Profitez d'une atmosphère élégante et raffinée.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card image-card">
                <img src="../assets/images/restaurants.jpg" alt="Restaurant Image 2">
                <div class="card-body">
                    <h5 class="card-title">Cuisine Exquise</h5>
                    <p class="card-text">Découvrez des plats savoureux préparés par nos chefs.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card image-card">
                <img src="../assets/images/restaurantss.jpg" alt="Restaurant Image 3">
                <div class="card-body">
                    <h5 class="card-title">Service Impeccable</h5>
                    <p class="card-text">Un service de qualité pour une expérience inoubliable.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Réservation Rapide -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 quick-reservation">
            <h2 class="text-center mb-4">Réservation Rapide</h2>
            <form>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="time" required>
                </div>
                <div class="mb-3">
                    <label for="guests" class="form-label">Nombre de personnes</label>
                    <input type="number" class="form-control" id="guests" required>
                </div>
                <div class="mb-3">
                    <label for="requests" class="form-label">Demandes spéciales</label>
                    <textarea class="form-control" id="requests" rows="3"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Section Horaires d'Ouverture -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center opening-hours">
            <h2>Horaires d'Ouverture</h2>
            <p><i class="fas fa-clock"></i>Lundi - Vendredi : 12h00 - 22h00</p>
            <p><i class="fas fa-clock"></i>Samedi - Dimanche : 10h00 - 23h00</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>ArtResidence</h5>
                <p>Une expérience culinaire unique à Porto-Novo</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Liens Utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="clients/reservation.php">Réservation</a></li>
                    <li><a href="clients/menu.php">Menu</a></li>
                    <li><a href="clients/admin.php">Connexion</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Contact</h5>
                <p>Email: contact@artresidence.com</p>
                <p>Téléphone: +229 123 456 789</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>&copy; 2024 ArtResidence. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</footer>

<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
