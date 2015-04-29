<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
if  (empty($_SESSION['utilisateur']) || empty($_SESSION['mdp']) ) 
{
	 header('Location: acces.php');
     exit();
}
else
{
	if ($_SESSION['natureUser']!= 1 )
	{
		header('Location: menuUser.php');
	}
}
?>



<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style2.css">
    <title>validation</title>
</head>

<body>

<div id="bandeau">
Validation des nouveaux contact
</div>

<?php
try
{
$conn = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

$sql ='SELECT * FROM validation WHERE CST="'.$_SESSION['id_agence'].'"';
$res = $conn->query($sql) ;
while($validation = $res->fetch())
{
?>
	<img src="<?php echo $validation['url_img']; ?>" class="imageflottante" alt="Image flottante" /><br/>'; 
	<?php
	echo '<br/>';
	echo '<h1>Nom: </h1>';
    echo $validation['nom'] ; 
	echo '<br/>';
	echo '<h1>Prenom: </h1>';
    echo $validation['prenom'] ; 
	echo '<br/>';
    echo '<h1>Pseudo: </h1>';
    echo $validation['User'] ; 
	echo '<br/>';
    echo '<h1>E-mail: </h1>';
    echo $validation['mail'] ; 
	echo '<br/>';
	echo '<br/>';
	
    echo '<a href="validation.php?action=accepter&id='.$validation['id_validation'].'"><input type="submit" value="Accepter"/></a>';
    echo '<a href="validation.php?action=refuser&id='.$validation['id_validation'].'"><input type="submit" value="refuser"/></a>';

    echo '<br/>';
}
$res->closeCursor();

if(isset($_GET['action']) AND isset($_GET['id']))
{
    $action = $_GET['action'];
    if($action == "accepter")
    {
        $id = $_GET['id'];
        $sql="SELECT * FROM validation WHERE id_validation='$id'";
        $quete2 = $conn->query($sql);
        $connexion = $quete2->fetch();

        $pseudo = $connexion['User'];
        $passe = $connexion['mdp'];
        $email = $connexion['mail'];
        $agence = $connexion['cst'];
		$val = 0;
		$quete2->closeCursor();
		
        $req = $conn->prepare("INSERT INTO utilisateur(User, mdp, superviseur, ID_agence, mail) VALUES(?, ?, ?, ?, ?)");
        $req->execute(array($pseudo, $passe, $val, $agence, $email));
				
        $req2 = $conn->query("DELETE FROM validation WHERE id_validation= '$id'");
        $req2->closeCursor();
		
		
		echo '<body onLoad="alert(\'Utilisateur ajoute...\')">';
	    echo '<meta http-equiv="refresh" content="0;URL=menu.php">';
    }
	
    elseif($action == "refuser")
    {
        $id = $_GET['id'];
        $req2 = $conn->prepare("DELETE FROM validation WHERE id_validation='$id'");
        $req2->execute();
		echo '<body onLoad="alert(\'Utilisateur supprime...\')">';
	    echo '<meta http-equiv="refresh" content="0;URL=menu.php">';
    }
}
?>
