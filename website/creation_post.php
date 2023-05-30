<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))  // isset = booleen (true ou false)
{
    header('location:form_compte.html');   // header: redirection
}

$logged_user = $_SESSION['user'];
$logged_user_id = $_SESSION['user_id'];


include 'connexion_bdd.php';

// lecture des donnees du formulaire de creation de poste
$form_titre_poste=$_POST['form_titre_poste'];   
$form_contenu_poste=$_POST['form_contenu_poste']; 

// ajout du poste dans la BDD
$query = "insert into posts (title,body,user_id) values ('$form_titre_poste','$form_contenu_poste','$logged_user_id');";
$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

// pas de resultat a lire car c'est une requete d'insertion dans la BDD, donc elle ne ramene pas de resultat

header('location:espace_utilisateur.php');

?>
