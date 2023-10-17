<?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header('location: ../../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenTrade - Page admin</title>
    <link rel="stylesheet" href="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <script src="../../client/public/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../../client/public/js/global.js"></script>
    <link rel="stylesheet" href="../../client/public/css/style.css">
</head>
<body>
    <!-- Barre navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GreenTrade</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Boutons CRUD -->
                    <li class="nav-item">
                        <button id="btnAjouterArticle" class="btn btn-link">Ajouter un Article</button>
                    </li>
                    <li class="nav-item">
                        <button id="btnListerArticles" class="btn btn-link">Lister les Articles</button>
                    </li>
                    <li class="nav-item">
                        <button id="btnListerParCategorie" class="btn btn-link">Lister par Catégorie</button>
                    </li>
                    <li class="nav-item">
                        <button id="btnModifierArticle" class="btn btn-link">Modifier un Article</button>
                    </li>
                    <li class="nav-item">
                        <button id="btnSupprimerArticle" class="btn btn-link">Supprimer un Article</button>
                    </li>
                </ul>
                <?php
                    echo "Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']." :)";
                ?>
            </div>
        </div>
    </nav>
    <!-- Fin barre navigation -->

    <h1>Page Admin</h1>

    <div class="container">
        <div id="contenuDynamique">
            <!-- Le contenu spécifique aux actions CRUD sera affiché ici -->
        </div>
    </div>

    <form id="formDeconnexion" action="../connexion/controleurConnexion.php" method="POST">
        <input type="hidden" name="action" value="deconnexion">
    </form>

    <script src="serveur/article/requetesArticle.js"></script>
    <script src="client/public/js/global.js"></script>
</body>

<br/>
<a href="../../index.php">Retour à l'accueil</a>
</html>
