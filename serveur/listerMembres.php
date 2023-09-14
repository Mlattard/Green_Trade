<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <link rel="stylesheet" href="../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="../client/public/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/public/js/global.js"></script>
</head>
<body>
<div class="container">
    <h1>Liste des Membres</h1>
    <i class="bi bi-file-plus" data-bs-toggle="modal" data-bs-target="#modalEnregistrerMembre">Ajouter un membre</i>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Adresse Email</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ficMembres = fopen("bd/membres.txt", "r");

                while (!feof($ficMembres)) {
                    $tab = explode(";", fgets($ficMembres));
                    if (count($tab) == 6) {
                        $nom = $tab[0];
                        $adresseEmail = $tab[1];
                        $motDePasse = $tab[2];
                        $adresse = $tab[3];
                        $ville = $tab[4];
                        $role = $tab[5];
                        ?>
                        <tr class="<?php echo ($role === 'Admin') ? 'table-danger' : 'table-success'; ?>">
                            <td><?php echo $nom; ?></td>
                            <td><?php echo $adresseEmail; ?></td>
                            <td><?php echo $adresse; ?></td>
                            <td><?php echo $ville; ?></td>
                            <td><?php echo $role; ?></td>
                        </tr>
                        <?php
                    }
                }
                fclose($ficMembres);
                ?>
            </tbody>
        </table>
    </div>
    <br> <a href="../index.php">Retour à la page d'accueil</a>
</div>


</body>
</html>
