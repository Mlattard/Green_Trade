<?php
    session_start();
    if(!isset( $_SESSION['role'])){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Membre</title>
</head>
<body>
    <h1>Page Membre en travaux, prévu pour la partie 3</h1>
</body>

<br/>
<a href="../../index.php">Retour à l'accueil</a>
</html>