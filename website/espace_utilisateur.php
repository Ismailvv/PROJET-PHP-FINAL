<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
}

$logged_user = $_SESSION['user'];
$is_admin=$_SESSION['role']=='admin';
include 'connexion_bdd.php';
?>

<?php 
function charger_tous_postes($con)
{
// affichage des postes
// formulation d'une requete de la bdd qui va checher les postes et le nom de leur createur
$query = "select posts.id as post_id, title, body, username from posts inner join users on users.id=posts.user_id;";  //Ce code en PHP effectue une requête SQL pour récupérer des données à partir de deux tables: "posts" et "users".
$res= $con->query($query);  

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}
return $res;
}

function charger_tagged_postes($con,$tag_title) // ON cherche tous les postes qui sont tagés par le $tag_title
{
$query = "select posts.id as post_id, posts.title, body, username from posts inner join users on users.id=posts.user_id ";  
$query = $query.'inner join post_tags on posts.id=post_tags.post_id inner join tags on post_tags.tag_id=tags.id  ';
$query = $query.' where tags.title="'.$tag_title.'";';
$res= $con->query($query);  

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}
return $res;
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="./styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fomrumlailre de creation de compte</title>
  </head>
  <body class="page">

<?php

echo "Bienvenu  $logged_user sur votre espace utilisateur <br>";
echo '<a href="logout.php">Se deconnecter</a><br>';
echo '<a href="espace_utilisateur.php">Afficher tous les posts</a><br>';

include 'form_post.html';

if (isset($_GET['tag']))
{
  $tag_title=$_GET['tag'];
  $res=charger_tagged_postes($con,$tag_title);
}
else $res=charger_tous_postes($con);

include 'liste_posts.php'; // affiche le post se trouvant dans $res



?>

</body>
</html>