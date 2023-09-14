<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple</title>
    <link rel="stylesheet" href="../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/public/css/style.css">
    <script src="../client/public/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/public/js/global.js"></script>
</head>
</body>
<div class="container">
<h1>Objets à vendre</h1>
    <?php
    $ficArticles = fopen("donnees/articles.txt","r");
    ?>

    <div class="row">
        <?php
        while(!feof($ficArticles)){
            $tab = explode(";", fgets($ficArticles));
            if (count($tab) == 5) {
                $nomProduit = $tab[0];
                $description = $tab[1];
                $categorie = $tab[2];
                $prix = $tab[3];
                $etat = $tab[4];
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Image -->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $nomProduit; ?></h5>
                            <p class="card-text"><?php echo $description; ?></p>
                            <p class="card-text"><strong>Catégorie:</strong> <?php echo $categorie; ?></p>
                            <p class="card-text"><strong>Prix:</strong> <?php echo $prix; ?></p>
                            <p class="card-text"><strong>État:</strong> <?php echo $etat; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        fclose($ficArticles);
        ?>
    </div>
    
    <br> <a href="../index.php">Retour à la page d'accueil</a>
</div>

</body>
</html>