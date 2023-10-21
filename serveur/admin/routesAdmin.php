<?php
    // Au début de PHP: Déclarer les types dans les paramétres des fonctions
    declare (strict_types=1);

    require_once("../article/controleurArticle.php");
   
    $instanceCtrl = ControleurArticle::getControleurArticle();

    echo $instanceCtrl->Ctrl_Article_Actions();
?>