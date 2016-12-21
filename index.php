<?php
session_start();

//ini_set('display_errors', 1);
include 'connexion_DB.php';
include_once'fonction/fonction.php';
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <meta charset="UTF-8">
        <!--<link href="vues/css/css.css" rel="stylesheet" type="text/css"/>-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title></title>
    </head>

    <body>
        <div class="container">
            <?php
            include'vues/menu_header_footer/header.php';
            include'vues/menu_header_footer/menu.php';
            ?>

            <div class="col-md-8">
                <?php
                $menu = $_GET['menu'];


                switch ($menu) {

                    case 'AjArt':
                        include'vues/Stock/AjoutArt.php';

                        break;
                    case 'AjQt':
                        include'vues/Stock/GestionQuantiter.php';

                        break;
                    case 'SupArt':
                        include'vues/Stock/SupprimeArticle.php';

                        break;

                    case 'vente':
                        include 'vues/ventes/ventespage1.php';
                        break;

                    case 'statut':
                        include 'vues/Stock/stock.php';
                        break;

                    case 'cuisine':
                        include 'vues/ventes/cuisine.php';
                        break;
                    case 'douche':
                        include 'vues/ventes/douche.php';
                        break;
                    ?></div><div col-md-12><?php
                    case 'panier':
                        include 'vues/ventes/panier.php';
                        break;  
                    case 'tout':
                        include 'vues/ventes/ventetout.php';
                        break;  
                }
                
                if($_POST[suppanier]=="supprimer panier")
                 {
                    session_unset();   
                 }
                
                ?>
                    </div>
            <div class="col-md-4">
                <?php
                if ($menu != 'panier'){
                affpani();}
                else {
                   
                    }
                    ?>
            </div>
        </div></body>
</html>
