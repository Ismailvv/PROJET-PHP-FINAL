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

// lecture des donnees du formulaire de creation de poste
$form_contenu_commentaire=$_POST['comment'];
$form_post_id=$_POST['post_id'];

// ajout du commentaire sur un poste dans la BDD
$query = 'insert into comments (body,post_id,user_id) values ("'.$form_contenu_commentaire.'","'.$form_post_id.'","'.$logged_user_id.'");';

$res= $con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

// pas de resultat a lire car c'est une requete d'insertion dans la BDD, donc elle ne ramene pas de resultat

header('location:espace_utilisateur.php#post'.$form_post_id);

?>

 <!-- CREATE TABLE `comments` ( -->
  <!-- `id` integer PRIMARY KEY AUTO_INCREMENT,
  `body` text COMMENT 'Content of the comment',
  `post_id` integer,
  `user_id` integer,
  `created_at` timestamp
); --> 