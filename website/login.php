<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();
include 'connexion_bdd.php';
$form_username=$_POST['username']; // La méthode POST en PHP est utilisée pour envoyer des données à un serveur dans une requête HTTP.
$form_password=$_POST['password'];

// verifier dabord s'il y a pas de compte avec le meme nom d'utilisateur
// formulation de la requete 1 sql pour tester si le nom d'utilisateur est deja pris
$query1 = "select * from users where username='$form_username';";
$res= $con->query($query1);

if (!$res) // tester si la requete est executee correctement
{
    die("erreur de requête");
}

//commencer a lire la premiere ligne du resultat de la requete
$ligne_user_bdd=$res->fetch(PDO::FETCH_ASSOC);
$login_correcte=true;

if (!$ligne_user_bdd) // s'il y a pas une ligne de resultat dans la reponse de la requete (pas d'utilisateur avec le login recherche
    $login_correcte=false;
else {
    if ($ligne_user_bdd['password']!=$form_password)
        $login_correcte=false;
}

if ($login_correcte==true)
{
    $_SESSION['user']=$form_username; // sauvegarder le cachet de validation de login dans la session
    $_SESSION['user_id']=$ligne_user_bdd['id'];
    $_SESSION['role']=$ligne_user_bdd['role'];
    header('location:espace_utilisateur.php'); // Passer dune page a une autre (redirection)
}
else{
    echo "Erreur, le nom d'utilisateur/mot de passe ne sont pas correcte<br>";
    echo '<a href="form_compte.html">Essayer a nouveau</a>';
}

?>