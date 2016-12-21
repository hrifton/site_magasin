<?php


define(USER, 'root');
define('PASSWORD','inaya');
define('DSN','mysql:host=localhost;dbname=youssef;charset=UTF8');

try {
$dbh = new PDO(DSN,USER,PASSWORD) ;  
} 

catch (PDOException $exception) {
    echo "Erreur ! :".$exception->getMessage()."<br/>";
    die();
}    
    
    
    ?>
