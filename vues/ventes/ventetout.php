<?php

//echo '<h1>Douche</h1><img src="vues/images/cuisine.jpg" alt="cuisine"/>';

$sql = "SELECT * FROM Stock";

$sth = $dbh->query($sql);
//var_dump($sth);

$stock = $sth->fetchall(PDO::FETCH_ASSOC);

echo '<form action="" method="POST">
           <table class="table table-striped">
       <thead>
       <tr>
       <th class="text-left">N° Article</th>
       <th class="text-left">Article</th>
       <th class="text-left">Quantité/s</th>
       <th class="text-left">Pris</th>
       <th class="text-left">Unité / Acheter</th>
    
    
       </tr>
       </thead>
       <tbody class="table table-striped">
       <tr>';
$i=0;
foreach ($stock as $row) {
    echo'<td class="text-left"><input type="hidden"name="num[]" value=' . $row['NumArt'] . '>' . $row['NumArt'] . '</td>
          <td class="text-left"><input type="hidden"name="nom[]" value=' . $row['NomArt'] . '>' . $row['NomArt'] . '</td>
          <td class="text-left"><input type="hidden"name="QtS[]" value=' . $row['QtStock'] . '>' . $row['QtStock'] . '</td>
          <td class="text-left"><input type="hidden"name="Pris[]" value=' . $row['Pris'] . '>' . $row['Pris'] . '</td>
          <td class="text-left"><input type="number" name="Qt[]" value="0"></td>
          </tr>';
    $i++;
}
echo '<tr><td class="text-left"><input type="submit"name="ok"/></tr></tbody></table></form>';

$panier=$_POST;

if (!empty($_SESSION['num'])) {

    ajoutQt_panier($panier);
    ajArt_panier($panier);
} else {
    cree_sess_panier($panier);
    
}
