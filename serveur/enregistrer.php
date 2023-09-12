 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple</title>
    <link rel="stylesheet" href="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/css/style.css">
    <script src="../client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/js/global.js"></script>
</head>
<body>
    <h2>ENREGISTREMENT D'UN FILM</h2> 
        <?php
            $titre = $_POST['titre'];
            $res = $_POST['res'];
            $duree = $_POST['duree'];

            $ficFilms = fopen("donnees/films.txt","a+");
            $ligne = $titre.";".$res.";".$duree."\n";
            fputs($ficFilms, $ligne);
            fclose($ficFilms);
            echo "Film ".$titre." a été bien enregistré";
        ?>
    <br>
    <a href="../index.html">Retour à la page d'accueil</a> 
</body>
</html>