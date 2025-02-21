<?php
require 'classes/Comment.php';

session_start();

$comment = new Comment();

$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$comments = $comment->getCommentsWithPagination($start, $limit);
$totalComments = $comment->getTotalComments();
$totalPages = ceil($totalComments / $limit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="./assets/img/logo1.webp" alt="Logo">
        </div>
        <div class="header-center">
            <img src="./assets/img/textname.png" alt="Text Logo">
        </div>
        <div class="login-button">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php" class="logout-btn">Déconnexion</a>
            <?php else: ?>
                <a href="#" class="login-btn">Connexion</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">
        <!-- Images qui défilent -->
        <div class="image-container">
            <img src="./assets/img/R.jpeg" alt="Image 1" class="active">
            <img src="./assets/img/img6.jpg" alt="Image 6">
            <img src="./assets/img/img13.jpeg" alt="Image 7">
            <img src="./assets/img/img16.jpg" alt="Image 8">
            <img src="./assets/img/img19.jpeg" alt="Image 9">
            <img src="./assets/img/img10.jpg" alt="Image 10">
            <img src="./assets/img/img21.jpg" alt="Image 11">
            <img src="./assets/img/img18.jpg" alt="Image 12">
        </div>

        <!-- Barre latérale des commentaires -->
        <div class="sidebar-container">
            <h2>Commentaires</h2>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <strong><?= htmlspecialchars($comment['prenom']) ?> <?= htmlspecialchars($comment['nom']) ?></strong>
                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                        <small><?= $comment['date'] ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="commentaires.php">Ajouter un commentaire</a>
            <?php else: ?>
                <a href="#" class="login-btn">Ajouter un commentaire</a>
            <?php endif; ?>

            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- Modal de connexion et d'inscription -->
    <div class="modal login-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Login')" id="defaultOpen">Connexion</button>
                <button class="tablinks" onclick="openTab(event, 'Register')">Inscription</button>
            </div>
            <div id="Login" class="tabcontent">
                <h2>Connexion</h2>
                <form id="login-form" action="auth.php" method="POST">
                    <input type="email" name="email" placeholder="E-mail" required autocomplete="email">
                    <input type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
                    <button type="submit" name="login_btn">Se connecter</button>
                </form>
            </div>
            <div id="Register" class="tabcontent">
                <h2>Inscription</h2>
                <form id="register-form" action="auth.php" method="POST">
                    <input type="text" name="prenom" placeholder="Prénom" required autocomplete="given-name">
                    <input type="text" name="nom" placeholder="Nom" required autocomplete="family-name">
                    <input type="email" name="email" placeholder="E-mail" required autocomplete="email">
                    <input type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                    <button type="submit" name="register">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 - Tous droits réservés</p>
    </footer>

    <script src="./assets/js/script.js"></script>
    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.image-container img');
        const totalImages = images.length;

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % totalImages;
            images[currentIndex].classList.add('active');
        }

        setInterval(showNextImage, 2000); // Vitesse de défilement plus rapide
    </script>
</body>
</html>