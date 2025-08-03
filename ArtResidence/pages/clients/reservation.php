<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtResidence - Réservation</title>
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
            max-width: 600px;
            animation: fadeInUp 1s ease-in-out;
        }
        .form-control {
            transition: box-shadow 0.3s ease-in-out;
        }
        .form-control:focus {
            box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
        }
        button {
            display: block;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }
        button:hover {
            background-color: #0056b3;
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
                    <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-calendar-alt"></i> Réservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/menu.php"><i class="fas fa-utensils"></i> Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../clients/admin.php"><i class="fas fa-user"></i> Connexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Formulaire de Réservation -->
<section class="container my-5">
    <h2>Réserver une Table</h2>
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
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
</section>

<script src="../../assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
