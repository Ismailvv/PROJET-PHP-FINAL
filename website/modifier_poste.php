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

$post_id=$_POST['post_id'];
$form_titre_poste=$_POST['form_titre_poste'];
$form_contenu_poste=$_POST['form_contenu_poste'];



// verifier que le poste appartient bien a l'utilisateur qui souhaite le modifier
// TODO




$query = "update posts set title='$form_titre_poste', body='$form_contenu_poste'  where id=$post_id"; // remplacer par les nouvelle modifications
$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
   die("erreur de requête");
}

// pas de resultat a lire car c'est une requete d'insertion dans la BDD, donc elle ne ramene pas de resultat

header('location:espace_utilisateur.php#post'.$post_id);

?>
