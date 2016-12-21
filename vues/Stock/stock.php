<h1>Stock</h1>
<!-- tout est a refaire mouahahhaha -->
<?php

$sql="select * from Stock";
       
$sth = $dbh->query($sql);
//echo 'dump';
//var_dump($sth);
         
            $art=$sth->fetchall(PDO::FETCH_ASSOC);
 echo '<table class="table">
       <thead>
       <tr>
       <th>N° Article</th>
       <th>Article</th>
       <th>Quantité</th>
       <th>Pris</th>
       </tr>
       </thead>
       <tbody>
       <tr>';
       foreach ($art as $article) {
                
    echo '<td>'.$article['NumArt'].'</td>
          <td>'.$article['NomArt'].'</td>
          <td>'.$article['QtStock'].'</td>
          <td>'.$article['Pris'].'</td>
          </tr>';
       }
            
            echo "</tbody></table>";
             // $art=$sth->fetchall(PDO::FETCH_ASSOC);
            //print_r ($art);

        ?>
 




