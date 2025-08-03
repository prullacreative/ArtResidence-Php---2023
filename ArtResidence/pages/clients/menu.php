<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtResidence - Menu</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #f8f9fa !important;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
            transition: color 0.3s ease-in-out;
        }
        .navbar-nav .nav-link i {
            margin-right: 5px;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        h2::after {
            content: '';
            width: 50px;
            height: 3px;
            background-color: #007bff;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .container {
            max-width: 800px;
            margin-top: 30px;
            animation: fadeInUp 1s ease-in-out;
        }
        .menu-item {
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .menu-item img {
            border-radius: 10px;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            border-top: 1px solid #e7e7e7;
        }
    </style>
</head>
<body>

<!-- Barre de Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">ArtResidence</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/reservation.php"><i class="fas fa-calendar-alt"></i> Réservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-utensils"></i> Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/admin.php"><i class="fas fa-user"></i> Connexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Menu Sections -->
<section class="container my-5">
    <h2>Petit-déjeuner</h2>
    <div class="row menu-section">
        <div class="col-md-4">
            <div class="card menu-item">
                <img src="../../assets/images/riz.jpg" class="card-img-top" alt="Plat de petit-déjeuner">
                <div class="card-body">
                    <h5 class="card-title">Omelette aux fines herbes</h5>
                    <p class="card-text">Délicieuse omelette aux fines herbes servie avec du pain grillé.</p>
                    <p class="card-text"><strong>Prix :</strong> 5€</p>
                </div>
            </div>
        </div>
        <!-- Ajoutez d'autres éléments de menu ici -->
    </div>

    <h2>Déjeuner</h2>
    <div class="row menu-section">
        <div class="col-md-4">
            <div class="card menu-item">
                <img src="../../assets/images/poulets.jpg" class="card-img-top" alt="Plat de déjeuner">
                <div class="card-body">
                    <h5 class="card-title">Salade César</h5>
                    <p class="card-text">Salade César fraîche avec poulet grillé et parmesan.</p>
                    <p class="card-text"><strong>Prix :</strong> 10€</p>
                </div>
            </div>
        </div>
        <!-- Ajoutez d'autres éléments de menu ici -->
    </div>

    <h2>Dîner</h2>
    <div class="row menu-section">
        <div class="col-md-4">
            <div class="card menu-item">
                <img src="../../assets/images/spaguetti.jpg" class="card-img-top" alt="Plat de dîner">
                <div class="card-body">
                    <h5 class="card-title">Filet de saumon</h5>
                    <p class="card-text">Filet de saumon grillé servi avec des légumes sautés.</p>
                    <p class="card-text"><strong>Prix :</strong> 15€</p>
                </div>
            </div>
        </div>
        <!-- Ajoutez d'autres éléments de menu ici -->
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 ArtResidence. Tous droits réservés.</p>
    </div>
</footer>

<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
