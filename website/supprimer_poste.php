<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
}

$logged_user = $_SESSION['user'];
$logged_user_id = $_SESSION['user_id'];


include 'connexion_bdd.php';

$post_id=$_GET['post_id'];


// verifier que le poste appartient bien a l'utilisateur qui souhaite le supprimer
// TODO

// suppression des commentaires du post
$query = "delete from comments where post_id=$post_id";
$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

// suppression des association du aux tags
$query = "delete from post_tags where post_id=$post_id";
$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}


// suppression du post
$query = "delete from posts where id=$post_id";
$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

// pas de resultat a lire car c'est une requete d'insertion dans la BDD, donc elle ne ramene pas de resultat

header('location:espace_utilisateur.php#post'.($post_id+1)); // aller ver le point d'ancrage du poste voisin

?>
