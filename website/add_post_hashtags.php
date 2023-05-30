<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();

// tester s'il y a un cachet de session pour autoriser l'acces a l'espace utilisateur
if (!isset($_SESSION['user']))
{
    header('location:form_compte.html');
}

function get_tag_id($con, $tag_title)
{
    $query = 'select id from tags where title="'.$tag_title.'";';
    $res= $con->query($query); //$res= mysqli_query($con,$query);
    if (!$res) // tester si la requete est executee correctement
    {
        die("erreur de requête");
    }
    $ligne_tag= $res->fetch(PDO::FETCH_ASSOC); //mysqli_fetch_array($res, MYSQLI_ASSOC);
    if ($ligne_tag) // si le tag existe deja dans la bdd, ramener son id
    {
        return $ligne_tag['id'];
    }

    // ajouter le tag car il n'existe pas deja
    $query = 'insert into tags (title) values("'.$tag_title.'");';
    $res= $con->query($query);
    if (!$res) // tester si la requete est executee correctement
    {
        die("erreur de requête");
    }
    $tag_id=$con->lastInsertId(); // fonction de mysqli qui ramene le id de la dernier insertion dans la bdd
    return $tag_id;
}

function attach_tag_topost($con, $post_id, $tag_id)
{
    $query = "select * from post_tags where post_id=$post_id and tag_id=$tag_id"; // Tester si le tag existe
    $res= $con->query($query);
    if (!$res) // tester si la requete est executee correctement
    {
        die("erreur de requête");
    }
    $ligne_tag=$res->fetch(PDO::FETCH_ASSOC);
    if ($ligne_tag) // si le tag est deja associe au poste, ne pas l'attacher a nouveau
    {
        return ;
    }

    // ajouter le tag car il n'existe pas deja
    $query = "insert into post_tags (post_id, tag_id) values($post_id,$tag_id);";
    $res= $con->query($query);
    if (!$res) // tester si la requete est executee correctement
    {
        die("erreur de requête");
    }
}


$logged_user = $_SESSION['user'];
$logged_user_id = $_SESSION['user_id'];


include 'connexion_bdd.php';

$post_id=$_GET['post_id'];
$hashtags=$_GET['hashtags'];
$tags = explode(',',$hashtags);

foreach ($tags as $tag_title)
{
    $tag_id=get_tag_id($con, $tag_title); // la fontion get_tagid  sert a ramener le tag id du tag
    attach_tag_topost($con, $post_id, $tag_id); // on va l'attacher au post
}
    
header('location:espace_utilisateur.php#post'.$post_id);
?>

// pour chaque tag recu, s'il exite deja dans la base, ramener son idate
// s'il n'existe pas, ajouter le a la table et recuperer son id

// ajouter les id des tags a la table post_tag avec le numero de post correspondant.
// si ta id de tag est deja ajouter au post, ne pas le dupliquer (on peut supprimer tou les anciennes association de tag)

// au niveau de l'affichage des poste, il faut afficher les nom des tag a cotes de chaque post
// le diaise de modification dopit apparaitre uniquement pour le createur du poste.

// a l'affichage du promt javascripot d'edition, il faut recuperer ces hashtags pour les editer_hashtag

// ajouter la fonctionnalite de recherche de haSHTAG SUR L'ESPACE UTILISATEUR


// verifier que le commentaire appartient bien a l'utilisateur qui souhaite le supprimer
// TODO

// suppression des commentaires du post
$query = "delete from comments where id=$comment_id";
$res= mysqli_query($con,$query);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

// pas de resultat a lire car c'est une requete d'insertion dans la BDD, donc elle ne ramene pas de resultat

header('location:espace_utilisateur.php');

?>

