<?php

function tableau() {
    include 'connexion_DB.php';
    $sql = "SELECT * FROM Stock";

    $sth = $dbh->query($sql);
    // var_dump($sth);

    $stock = $sth->fetchall(PDO::FETCH_ASSOC);

    echo '<form methode="GET" action="">
           <table class="table-fill">
       <thead>
       <tr>
       <th class="text-left">N° Article</th>
       <th class="text-left">Article</th>
       <th class="text-left">Quantité/s</th>
       <th class="text-left">Prix</th>
       <th class="text-left">Quantité/achat</th>
       <th class="text-left"></th>
    
       </tr>
       </thead>
       <tbody class="table-hover">
       <tr>';
    foreach ($stock as $a) {
        echo'<td class="text-left">' . $a['NumArt'] . '</td>
          <td class="text-left">' . $a['NomArt'] . '</td>
          <td class="text-left">' . $a['QtStock'] . '</td>
          <td class="text-left">' . $a['Pris'] . '</td>
          <td class="text-left"><input type="number" name="Qt" values="0"</td>
         
          
          </tr>';
    }
    echo '<tr><td class="text-left"><input type="submit"value="validé"/></tr></tbody></table></form>';
}

// $art=$sth->fetchall(PDO::FETCH_ASSOC);
//print_r ($art);

function ajoutQt_panier($panier) {//ajout quantité dans le panier deja existant
    
    $nb = count($panier['num']);
    for ($i = 0; $i < $nb; $i++) {

        $key = array_search($panier['num'][$i], $_SESSION['num']); // trouver la ligne de l'article
        if ($panier['num'][$i] == $_SESSION['num'][$key]) {//verifier si les deux produit sont identique
            if (($panier['Qt'][$i]) > 0) {//pour ne pas introduire d'article avec qt 0
               $_SESSION['Qt'][$key] =  $panier['Qt'][$i];
                $_SESSION['total'][$key] = $_SESSION['Qt'][$key] * $_SESSION['Pris'][$key];
            }
        }
    }
}

function dimiQt_panier() {//ajout quantité dans le panier deja existant
    $panier = $_POST;
    $nb = count($panier['num']);
    for ($i = 0; $i < $nb; $i++) {
        $key = array_search($panier['num'][$i], $_SESSION['num']);
        $_SESSION['Qt'][$i] = $panier['Qt'][$i];
        $_SESSION['total'][$i] = $_SESSION['Qt'][$i] * $_SESSION['Pris'][$i];
        echo $key . '<br/>';
    }
}

function cree_sess_panier($panier) {//creation du panier en session pas encore existant
    $nb = count($panier['num']);

    if (empty($_SESSION['num'])) {
        for ($i = 0; $i < $nb; $i++) {
            if ($panier['Qt'][$i] != 0) {
                $_SESSION['num'][] = $panier['num'][$i];
                $_SESSION['nom'][] = $panier['nom'][$i];
                $_SESSION['Qt'][] = $panier['Qt'][$i];
                $_SESSION['Pris'][] = $panier['Pris'][$i];
                $_SESSION['total'][] = $panier['Qt'][$i] * $panier['Pris'][$i];
            }
        }
    }

    return $_SESSION;
}

function ajArt_panier($panier) {//ajout article supplementaire 
    
    $nbPan = count($panier['num']);

    for ($i = 0; $i < $nbPan; $i++) {
        if (!in_array($panier['num'][$i], $_SESSION['num'])) {
            if ($panier['Qt'][$i] > 0) {
                // echo "article ".$panier['num'][$i]." est pas dans la session";
                $_SESSION['num'][] = $panier['num'][$i];
                $_SESSION['nom'][] = $panier['nom'][$i];
                $_SESSION['Qt'][] = $panier['Qt'][$i];
                $_SESSION['Pris'][] = $panier['Pris'][$i];
                $_SESSION['total'][] = $panier['Qt'][$i] * $panier['Pris'][$i];
            }
        }
    }
}

function affpani() {


    $totpanier = 0;
    $nbsess = count($_SESSION['num']);

    echo'<table class="table table-bordered">
  <thead>
  <tr>
  <th class="text-left">N° Article</th>
  <th class="text-left">Quantité</th>
  <th class="text-left">Prix</th>
  <th class="text-left">Total</th>


  </tr>
  </thead>
  <tbody>
  <tr>';

    for ($i = 0; $i < $nbsess; $i++) {
       // if ($_SESSION['Qt'][$i] > 0) {
            echo '<td >' . $_SESSION['num'][$i] . '</td>
              <td >' . $_SESSION['Qt'][$i] . '</td>
              <td >' . $_SESSION['Pris'][$i] . '</td>
              <td >' . $_SESSION['total'][$i] . '</td></tr>';
            $totpanier = $totpanier + $_SESSION['total'][$i];
        //}
    }

    echo "<tfoot><td><h3>Total</h3></td><td></td><td></td><td><h3>$totpanier</h3></td></tfoot></tbody></table>";
    echo'<form action="" method="POST">'
    . '<input type="submit"name="suppanier"value="supprimer panier"/></form>';
}

function panierfianl()
{
     suppart();
$nbsess = count($_SESSION['num']);
    $total = 0;
    echo '<form action="" method="POST">
           <table class="table table-striped">
       <thead>
       <tr>
       <th class="text-left">N° Article</th>
       <th class="text-left">Article</th>
       <th class="text-left">Prix</th>
       <th class="text-left">Quantité</th>
       <th class="text-left">Total</th>
       <th class="text-left">Supp/Art</th>
       
    
    
       </tr>
       </thead>
       <tbody class="table table-striped">
       <tr>';

    for ($i = 0; $i < $nbsess; $i++) {
if($_SESSION['Qt'][$i]>0){
        echo'<td class="text-left"><input type="hidden"name="num[]" value=' . $_SESSION['num'][$i] . '>' . $_SESSION['num'][$i] . '</td>
          <td class="text-left"><input type="hidden"name="nom[]" value=' . $_SESSION['nom'][$i] . '>' . $_SESSION['nom'][$i] . '</td>
          <td class="text-left"><input type="hidden"name="Pris[]" value=' . $_SESSION['Pris'][$i] . '>' . $_SESSION['Pris'][$i] . '</td>
          <td class="text-left"><input type="number"name="Qt[]" value=' . $_SESSION['Qt'][$i] . '></td>          
          <td class="text-left"><input type="hidden"name="total[]" value=' . $_SESSION['total'][$i] . '>' . $_SESSION['total'][$i] . '</td>
          <td class="text-left"><input type="checkbox"name="supp[]" value=' . $_SESSION['num'][$i] . '></td>          
          </tr>';
        $total = $total + $_SESSION['total'][$i];
    }
    
}
    
    echo '<tr><td class="text-left"><input type="submit"name="ok"/></td><td></td><td>Total</td><td></td><td>' . $total . '</td></tr></tbody></table></form>';

   //  echo'<pre>'; 
  //var_dump($_SESSION); 
  //echo'</pre>';
}

function suppart()
{
    $supp=$_POST['supp'];
    $nbsupp=count($supp);
    $nbsess=count($_SESSION['num']);
    
    for($i=0;$i<$nbsess;$i++)
    {
       if(!in_array($_SESSION['num'][$i], $supp)){
                $num[] = $_SESSION['num'][$i];
                $nom[] = $_SESSION['nom'][$i];
                $Qt[] = $_SESSION['Qt'][$i];
                $Pris[] = $_SESSION['Pris'][$i];
                $total[] = $_SESSION['Qt'][$i] * $panier['Pris'][$i];
       }
    }
    
    $temp=count($num);
   // echo $temp;
    unset($_SESSION['num'],$_SESSION['nom'],$_SESSION['Qt'],$_SESSION['Pris'],$_SESSION['total']);
    unset($_POST['supp']);
   
    for($i=0;$i<$temp;$i++)
    {           $_SESSION['num'][]=$num[$i];
                $_SESSION['nom'][] = $nom[$i];
                $_SESSION['Qt'][] = $Qt[$i];
                $_SESSION['Pris'][] = $Pris[$i];
                $_SESSION['total'][]=$Qt[$i]*$Pris[$i];
       
    }
   $panier=$_POST;
    ajoutQt_panier($panier);
    
    unset($num,$nom,$Qt,$Pris,$total);
   
}