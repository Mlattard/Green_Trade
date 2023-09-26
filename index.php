<?php
    if(isset($_COOKIE['PHPSESSID'])){
        unset($_COOKIE);
    }
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GreenTrade - Accueil</title>
        <link rel="stylesheet" href="client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
        <script src="client/public/utilitaires/jquery-3.6.3.min.js"></script>
        <script src="client/public/utilitaires/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
        <script src="client/public/js/global.js"></script>
        <link rel="stylesheet" href="client/public/css/style.css">
    </head>

    <body>
        <!-- Barre navigation -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">GreenTrade</a>
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
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConnexion">Se Connecter</a>
                        </li>
                        <!-- Lien Devenir Membre -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalDevenirMembre">Devenir Membre</a>
                        </li>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:lister();">Objets à vendre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:listerMembres();">Liste des membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalEnregistrer">Ajouter un objet</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Fin barre navigation -->
        
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card_perso" style="width: 18rem;">
                        <img src="serveur/film/pochettes/$ligne->photo" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">$ligne->nom</h5>
                            <h5 class="card-title">$ligne->prenom</h5>
                            <p class="card-text">$ligne->daten</p>
                            <p class="card-text">$ligne->courriel</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <!-- Répétez ces quatre colonnes pour chaque carte supplémentaire -->
            </div>
        </div>

        <!-- Modal enregistrer un membre -->
        <div class="modal fade modal-custom-width" id="modalDevenirMembre" tabindex="-1" aria-labelledby="exampleModalLabelMembre" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabelMembre">Enregistrer un nouveau membre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgErrEnregMembre"></span>
                        <form class="row g-3" action="serveur/membre/controleurMembre.php" method="POST" enctype="multipart/form-data" onSubmit="return validerFormEnreg();">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom du membre</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom du membre</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="col-md-12">
                                <label for="courriel" class="form-label">Adresse Email</label>
                                <input type="email" class="form-control " id="courriel" name="courriel" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mdp" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control " pattern="^[A-Za-Z0-9_\$#!\-]{6,10}$" id="mdp" name="mdp" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mdpc" class="form-label">Confirmer mot de passe</label>
                                <input type="password" class="form-control " pattern="^[A-Za-Z0-9_\$#!\-]{6,10}$" id="mdpc" name="mdpc" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select class="form-select " id="sexe" name="sexe" required>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                    <option value="A">Autre</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="daten" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control is-valid" id="daten" name="daten">
                            </div>
                            <div class="col-md-12">
                                <label for="photo" class="form-label">Ajouter votre photo</label>
                                <input type="file" class="form-control is-valid " id="photo" name="photo[]">
                            </div>
                            <br />
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

        <!-- Modal connexion membre -->
        <div class="modal fade modal-custom-width" id="modalConnexion" tabindex="-1" aria-labelledby="exampleModalLabelMembre" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabelMembre">Connexion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgErrConnexion"></span>
                        <form class="row g-3" action="serveur/connexion/controleurConnexion.php" method="POST">
                            <div class="col-md-12">
                                <label for="courrielConnexion" class="form-label">Adresse Email</label>
                                <input type="email" class="form-control " id="courrielConnexion" name="courrielConnexion" required>
                            </div>
                            <div class="col-md-12">
                                <label for="mdpConnexion" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control " pattern="^[A-Za-z0-9_\$#!\-]{6,10}$" id="mdpConnexion" name="mdpConnexion" required>
                            </div>
                            <input type="hidden" name="action" value="connexion">
                            <br />
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal connexion -->

        <!-- Modal enregistrer un article -->
        <div class="modal fade modal-custom-width" id="modalEnregistrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer un nouvel article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgErrEnregArticle"></span>
                        <form class="row g-3" action="serveur/enregistrer.php" method="POST">
                            <div class="col-md-12">
                                <label for="nomProduit" class="form-label">Nom du produit</label>
                                <input type="text" class="form-control " id="nomProduit" name="nomProduit" required>
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control " id="description" name="description" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="categorie" class="form-label">Catégorie</label>
                                <input type="text" class="form-control " id="categorie" name="categorie" required>
                            </div>
                            <div class="col-md-12">
                                <label for="prix" class="form-label">Prix</label>
                                <input type="number" min="0" step="0.01" class="form-control " id="prix" name="prix" required>
                            </div>
                            <div class="col-md-12">
                                <label for="etat" class="form-label">État</label>
                                <select class="form-select " id="etat" name="etat" required>
                                    <option value="Neuf">Neuf</option>
                                    <option value="Occasion">Occasion</option>
                                </select>
                            </div>
                            <br />
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
        <!-- Fin modal enregistrer un article -->

        <!-- Formulaire lister -->
        <form id="formLister" action="serveur/lister.php" method="POST"></form>
        <form id="formListerMembres" action="serveur/listerMembres.php" method="POST"></form>
        <!-- Fin formulaire lister -->
    </body>

    <script>
        $('form input').on("input", function () {
            $(document).ready(function () {// Vérifiez si l'entrée est valide (par exemple, non vide)
                if ($(this).val().trim() !== "") {
                    // Si l'entrée est valide, ajoutez la classe CSS "is-valid"
                    $(this).addClass("is-valid");
                } else {
                    // Si l'entrée n'est pas valide, retirez la classe CSS "is-valid"
                    $(this).removeClass("is-valid");
                }
            });
        });
    </script>
</html>