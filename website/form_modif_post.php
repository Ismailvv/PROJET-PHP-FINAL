<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
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

$logged_user = $_SESSION['user'];
$logged_user_id = $_SESSION['user_id'];

include 'connexion_bdd.php';
$post_id=$_GET['post_id'];


// verifier que le poste appartient bien a l'utilisateur qui souhaite le supprimer
// TODO



// lire les donnees du post
$query = "select title, body from posts where id =$post_id;";
$res=$con->query($query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}
$ligne_poste_bdd=$res->fetch(PDO::FETCH_ASSOC);
$titre_poste = $ligne_poste_bdd['title'];
$contenu_poste = $ligne_poste_bdd['body'];
?>


<div class="form_post_container">
  <div class="form_post_header">Formulaire de creation de post</div>
  <form action="modifier_poste.php" method="post">
  <input type="hidden" name="post_id" value="<?php echo $post_id;?>"/>
    <div class="post_title">Titre du poste:</div>
    <input type="texte" name="form_titre_poste"  value="<?php echo $titre_poste;?>"/><br />
    <div class="post_title">Contenu du poste:</div>
    <textarea rows="4" cols="60" name="form_contenu_poste">
    <?php echo $contenu_poste;?> </textarea>
    <br />
    <input class="comment_button" type="submit" value="Enregistrer" />
  </form>
</div>

</body>
</html>