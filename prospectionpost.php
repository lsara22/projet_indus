

<?php
session_start ();

// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

  
	if (empty($_POST['Date']) || empty($_POST['Nature']) || empty($_POST['Entreprise']) || empty($_POST['Contact']))
	{
header('Location: formulaireProspection.php');
	}

	else
	{
// Redirection du visiteur vers la page d'acceuil
// Insertion du message à l'aide d'une requête préparée
$val_Entreprise= mysql_real_escape_string(mb_strtoupper($_POST['Entreprise']));
$val_Nature= mysql_real_escape_string(mb_strtoupper($_POST['Nature']));
$val_Fonction= mysql_real_escape_string(mb_strtoupper($_POST['Fonction']));
$val_Contact= mysql_real_escape_string(mb_strtoupper($_POST['Contact']));
$val_agence=$_SESSION['id_agence'];

$req = $bdd->prepare('INSERT INTO prospection(Date, Nature, PME, Entreprise, Contact, Fonction, Telephone, Mail, commentaire, id_agence, prospecteur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
$req->execute(array($_POST['Date'], $val_Nature, $_POST['PME'], $val_Entreprise, $val_Contact, $val_Fonction, $_POST['Telephone'], $_POST['Mail'], $_POST['commentaire'], $val_agence, $_POST['ajout']));
// Le visiteur n'a pas été reconnu comme étant membre de notre site. 
		echo '<body onLoad="alert(\'Prospection ajoutee...\')">';
		// puis on le redirige vers la page d'accueil
		echo '<meta http-equiv="refresh" content="0;URL=menu.php">';
	}
?>
