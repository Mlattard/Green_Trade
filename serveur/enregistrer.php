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
<body>
    <h2>ENREGISTREMENT D'UN ARTICLE</h2> 
    <?php
        $nomProduit = $_POST['nomProduit'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $prix = $_POST['prix'];
        $etat = $_POST['etat'];

        $ficArticles = fopen("bd/articles.txt", "a+");
        $ligne = $nomProduit . ";" . $description . ";" . $categorie . ";" . $prix . ";" . $etat . "\n";
        fputs($ficArticles, $ligne);
        fclose($ficArticles);
        echo "L'article " . $nomProduit . " a été bien enregistré";
    ?>

    <br>
    <a href="../index.php">Retour à la page d'accueil</a> 
</body>
</html>