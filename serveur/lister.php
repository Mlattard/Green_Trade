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
</body>
  <div class="container">
    <?php
        $ficFilms = fopen("donnees/films.txt","r");

        $rep = <<<REPONSE

        <div class="table-responsive">
            <table class="table table-dark table-striped table-sm align-middle">
                <thead>
                    <tr>
                    <th>Titre</th>
                    <th>Réalisateur</th>
                    <th>Durée</th>
                    </tr>
                </thead>
                <tbody>
        REPONSE;

        $ligne = fgets($ficFilms);
        while(!feof($ficFilms)){
            $tab = explode(";", $ligne);
            $rep .= <<<SUITE_REPONSE
                <tr>
                    <td>$tab[0]</td>
                    <td>$tab[1]</td>
                    <td>$tab[2]</td>
                </tr>
            SUITE_REPONSE;
            $ligne = fgets($ficFilms);
        }
        $rep .= "</tbody></table>";
        fclose($ficFilms);
        echo $rep;
    ?>
    <br> <a href="../index.html">Retour à la page d'accueil</a> 
    </div>
</body>
</html>