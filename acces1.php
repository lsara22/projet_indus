<?php

if (isset($_POST['user']) && isset($_POST['mdp'])) 
{
$login = $_POST['user'];
$pwd = $_POST['mdp'];
$pwd = sha1($pwd);

// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$reponse = $bdd->query('SELECT * FROM utilisateur WHERE User ="'.$login.'" AND mdp ="'.$pwd.'"');
$res = $reponse->fetch();
$reponse->closeCursor(); 

if ($res) 
    {
		// on la démarre 
		session_start ();
		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
		$_SESSION['utilisateur'] = $login;
		$_SESSION['mdp'] = $pwd;
		$_SESSION['natureUser'] = $res['superviseur'];
		$_SESSION['id_agence'] = $res['ID_agence'];
		
		if($_SESSION['natureUser'] == 1)
		{
	   	// on redirige notre visiteur vers une page de notre section membre
		header ('location: menu.php');
		}
		
		if ($_SESSION['natureUser'] == 0)
		{
	   	// on redirige notre visiteur vers une page de notre section membre
		header ('location: menuUser.php');
		}
		
		if ($_SESSION['natureUser'] == 5)
		{
	   	// on redirige notre visiteur vers une page de notre section membre
		header ('location: menuAdmin.php');
		}
			
    }
	
  
	
 else 
    {
		// Le visiteur n'a pas été reconnu comme étant membre de notre site. 
		echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		// puis on le redirige vers la page d'accueil
		echo '<meta http-equiv="refresh" content="0;URL=acces.php">';
    }
}

else 
{
	echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>
