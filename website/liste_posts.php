<?php 
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
}
?>

<?php
function get_tags_list($con, $post_id)
{
    $query = "select title from tags inner join post_tags on tags.id=post_tags.tag_id where post_id=$post_id;";
    $res= $con->query($query);
    if (!$res) // tester si la requete est executee correctement
    {
        die("erreur de requête");
    }
    $ligne_tag=$res->fetch(PDO::FETCH_ASSOC);
    $tags_list='';
    while ($ligne_tag) // lire les tags du post
    {
        $tag= $ligne_tag['title'];
        $tag_link='<a href="espace_utilisateur.php?tag='.$tag.'"> #'.$tag.'</a>';
        if ($tags_list=='') //tester s'il faut mettre un , de separation
            $tags_list=$tag_link;
        else $tags_list=$tags_list.' , '.$tag_link;
        $ligne_tag=$res->fetch(PDO::FETCH_ASSOC);
    }
    return $tags_list;  // On retur la liste final 
}



?>

<?php
$logged_user = $_SESSION['user'];
$logged_user_id = $_SESSION['user_id'];

$ligne_poste_bdd=$res->fetch(PDO::FETCH_ASSOC);

// c'est la boucle d'affichage des postes
while ($ligne_poste_bdd) // On boucle sur l'ensemble des posts
{
    $post_id=$ligne_poste_bdd['post_id'];
    include 'le_poste.php';
    $ligne_poste_bdd=$res->fetch(PDO::FETCH_ASSOC);
}
?>


<script>
function supprimer(post_id)
{
    ok=confirm("Etes vous sur de vouloir supprimer le poste (attention tous les commentaires du poste vont étre supprimes ?"); // confirme affiche une question avec une reponse a choisir
    if (ok)
    {
        // rediriger vers la page de suppression
        window.location.replace("supprimer_poste.php?post_id="+post_id);   // C'est une redirection cote client vers la page de suppression en language js
    }
}

function editer_hashtag(post_id)
{
    let hashtags=prompt("Donner vos hashtags separes par des virgules:"); // AFFICHER UN MESSAGE ET LIRE 
    if (hashtags)
        window.location.replace("add_post_hashtags.php?post_id="+post_id+"&hashtags="+hashtags); 
}

function modifier(post_id)
{
        // rediriger vers la page de modification
        window.location.replace("form_modif_post.php?post_id="+post_id);   // C'est une redirection cote client vers la page de modification en language js
}
</script>