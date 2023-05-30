<?php

$host_dbname="mysql:host=localhost;dbname=exoposts";
$bdd_username="root";
$bdd_password="root";

// fonction du packet mysqli pour l'acces a la bdd mysql
try {
 $con = new PDO($host_dbname,$bdd_username,$bdd_password); //ouverture de connexion avec la bdd   
} catch(PDOException $e){
    die ('erreur de connexion a la bdd ');
}

?>