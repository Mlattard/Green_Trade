<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement d'un Membre</title>
    <link rel="stylesheet" href="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/css/style.css">
    <script src="../client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/js/global.js"></script>
</head>
<body>
    <h2>ENREGISTREMENT D'UN MEMBRE</h2> 
    <?php
        $nomMembre = $_POST['nomMembre'];
        $emailMembre = $_POST['emailMembre'];
        $motDePasse = $_POST['motDePasse'];
        $adresseMembre = $_POST['adresseMembre'];
        $villeMembre = $_POST['villeMembre'];
        $roleMembre = $_POST['roleMembre'];

        $ficMembres = fopen("donnees/membres.txt", "a+");
        $ligne = $nomMembre . ";" . $emailMembre . ";" . $motDePasse . ";" . $adresseMembre . ";" . $villeMembre . ";" . $roleMembre . "\n";
        fputs($ficMembres, $ligne);
        fclose($ficMembres);
        echo "Le membre " . $nomMembre . " a été bien enregistré";
    ?>

    <br>
    <a href="../index.php">Retour à la page d'accueil</a> 
</body>
</html>
