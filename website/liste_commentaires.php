
<?php
$query_c = "select username, body, comments.id as comment_id, users.id as comment_user_id from comments inner join users on users.id=comments.user_id where comments.post_id=".$post_id.";";  //Ce code en PHP effectue une requête SQL pour récupérer des données à partir de deux tables: "posts" et "users".
$res_c= $con->query($query_c);

if (!$res_c) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

//commencer a lire la premiere ligne du resultat de la requete
$ligne_commentaire_bdd=$res_c->fetch(PDO::FETCH_ASSOC);
//echo "<ul>";
while ($ligne_commentaire_bdd) // On boucle sur l'ensemble des posts
{
    echo '<div class="post_comment">';
    echo '<img class="post_control_icon" src="./image/user.png"/>';
    if ($is_admin || $logged_user_id == $ligne_commentaire_bdd['comment_user_id'])
    {
    echo '<a href="sup_commentaire.php?comnment_id='.$ligne_commentaire_bdd['comment_id'] .'"><img class="comment_delete_icon" src="./image/croix.png"/></a>'; // supprimer le commentaire du post
    }
    echo '<div class="comment_text">'.$ligne_commentaire_bdd['username'];
    echo ' : '.$ligne_commentaire_bdd['body']. '</div>';
    echo '</div>';
    $ligne_commentaire_bdd=$res_c->fetch(PDO::FETCH_ASSOC);
}
//echo "</ul>";   // lire les commentaire du post a partir de la base de donnees
?>