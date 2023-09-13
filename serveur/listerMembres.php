<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <link rel="stylesheet" href="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../client/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">

    <script src="../client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="../client/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../client/js/global.js"></script>
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
                $ficMembres = fopen("donnees/membres.txt", "r");

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

<!-- Modal enregistrer un membre -->
<div class="modal fade" id="modalEnregistrerMembre" tabindex="-1" aria-labelledby="exampleModalLabelMembre" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabelMembre">Enregistrer un nouveau membre</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgErrEnregMembre"></span>
                    <form class="row g-3" action="serveur/enregistrerMembre.php" method="POST">
                        <div class="col-md-12">
                            <label for="nomMembre" class="form-label">Nom du membre</label>
                            <input type="text" class="form-control is-valid" id="nomMembre" name="nomMembre" required>
                        </div>
                        <div class="col-md-12">
                            <label for="emailMembre" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control is-valid" id="emailMembre" name="emailMembre" required>
                        </div>
                        <div class="col-md-12">
                            <label for="motDePasse" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control is-valid" id="motDePasse" name="motDePasse" required>
                        </div>
                        <div class="col-md-12">
                            <label for="adresseMembre" class="form-label">Adresse</label>
                            <input type="text" class="form-control is-valid" id="adresseMembre" name="adresseMembre" required>
                        </div>
                        <div class="col-md-12">
                            <label for="villeMembre" class="form-label">Ville</label>
                            <input type="text" class="form-control is-valid" id="villeMembre" name="villeMembre" required>
                        </div>
                        <div class="col-md-12">
                            <label for="roleMembre" class="form-label">Rôle</label>
                            <select class="form-select is-valid" id="roleMembre" name="roleMembre" required>
                                <option value="Admin">Admin</option>
                                <option value="Membre">Membre</option>
                            </select>
                        </div>
                        <br/>
                        <div class="col-6">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger" type="reset">Vider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin modal enregistrer un membre -->
</body>
</html>
