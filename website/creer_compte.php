<?php
if (session_status()!= PHP_SESSION_ACTIVE) session_start();
include 'connexion_bdd.php';
$username=$_POST['username']; // La méthode POST en PHP est utilisée pour envoyer des données à un serveur dans une requête HTTP.
$password=$_POST['password'];

if (strlen($username)<3 || strlen($password)<3)
{
    ?>

    Erreur, le nom d'utilisateur / mot de passe doivent etre aux moins 3 caracteres <br>
    <a href="form_compte.html">Creer un compte utilisateur</a>

    <?php return;
}
// verifier dabord s'il y a pas de compte avec le meme nom d'utilisateur
// formulation de la requete 1 sql pour tester si le nom d'utilisateur est deja pris
$query1 = "select * from users where username='$username';";
$res= $con->query($query1);
if (!$res)    // Pur verifier si il ya une erreur de requete
{
    die("erreur de requete");
}
$ligne=$res->fetch(PDO::FETCH_ASSOC);
$username_existe=false;
if ($ligne){      // Pour verifier si le nom existe deja
    $username_existe=true;
}

if ($username_existe==false)
{
// creation du compte
// formulation de la requete 2 sql pour l'insertion de donnees
$query2 = "insert into users (username,role,password) values ('$username' , 'user' ,'$password');";

// soumettre la requete sql a la bdd
$res= $con->query($query2);
if (!$res)
{
    echo "errer de creation de compte";
   
}
else {echo "compte bien cree<br>";
    echo '<a href="form_compte.html">Cliquer pour vous connectez</a>';
}
}
else
{
    ?>

    Erreur, il existe deja un compte avec le mem nom d'utilisateur<br>
    <a href="form_compte.html">Creer un compte utilisateur</a>

    <?php
}


?>