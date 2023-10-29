<?php
    session_start();
    if(!isset( $_SESSION['role'])){
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
        <title>GreenTrade - Page membre</title>
        <link rel="stylesheet" href="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../client/public/utilitaires/icons-1.8.1/bootstrap-icons.css">
        <script src="../../client/public/utilitaires/jquery-3.6.3.min.js"></script>
        <script src="../../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
        <script src="../../client/public/js/global.js"></script>
        <script src="../../client/membre/requetesMembre.js"></script>
        <script src="../../client/membre/vuesMembre.js"></script>
        <link rel="stylesheet" href="../../client/public/css/style.css">
    </head>
    <body onLoad="listerArticlesCards();">  
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
                        <!-- Lien Accueil -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                        </li>
                        <!-- Lien Se connecter -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profil</a>
                        </li>
                        <!-- Lien Devenir Membre -->
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
    <div class="barrePanier">
        <a id="panier" class="nav-link" href="javascript:afficherPanier();"><i class="bi bi-cart panierPlus"></i></a>
        <span id="nbart">0</span>
    </div>

    <!-- Contenu page -->
    <div id="contenuMembre"></div>

    </div>
    <form id="formDeconnexion" action="../connexion/controleurConnexion.php" method="POST">
        <input type="hidden" name="action" value="deconnexion">
    </form>
</body>

</html>