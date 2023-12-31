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
    <script src="../../client/public/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../../client/public/js/global.js"></script>
    <script src="../../client/admin/requetesAdmin.js"></script>
    <script src="../../client/admin/vuesAdmin.js"></script>
    <link rel="stylesheet" href="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../client/public/css/style.css">
</head>

<body onLoad="listerArticlesTab();">
    <!-- Barre navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="..\membre\photos\logo.png" alt="Logo de GreenTrade" class="logo" style="width: 50px; height: auto; margin-right: 10px;">
                GreenTrade 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Boutons CRUD -->
                    <li class="nav-item">
                        <a id="btnAfficherCategorie" class="nav-link" aria-current="page" href="#" onclick="listerArticlesTab()">Afficher les articles</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnAjouterArticle" class="nav-link" aria-current="page" href="#" onclick="afficherModalEnregistrerArticle()">Enregistrer un article</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnListerArticle" class="nav-link" aria-current="page" href="#" onclick="afficherArticlesParCategorie()">Lister par categorie</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnAfficherMembre" class="nav-link" aria-current="page" href="#" onclick="listerMembresTab()">Afficher les membres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:document.getElementById('formDeconnexion').submit();">Deconnexion</a>
                    </li>
                </ul>
                <?php
                    echo "<div class = 'infoMembre'><img class = 'avatar' src='".$_SESSION['photo']."'width=48 height=48>"."Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']." :)</div>";
                ?>
            </div>
        </div>
    </nav>

    <!-- Fin barre navigation -->

    <div id="contenuAdmin"></div>

    <div id="modals"></div>

    <form id="formDeconnexion" action="../connexion/controleurConnexion.php" method="POST">
        <input type="hidden" name="action" value="deconnexion">
    </form>
</body>
</html>
