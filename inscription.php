<?php

/* include 'fonctions.php'; */

if(!empty($_POST['nom'])) 
{
    try
    {
        $conn = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }


// Je mets aussi certaines sécurités ici…
$passe = $_POST['passe'];
$passe2 = $_POST['passe2'];


if($passe == $passe2) 
{
	/* if(check_email($email) == true)
    { */
    $nom = $_POST['nom'];
    $conca = '.';
    $prenom = $_POST['prenom'];
    $conca = $conca.$prenom;
    $pseudo = $nom.$conca;
    $agence = $_POST['cst'];
	$email = ($_POST['email']);
	
// Je vais crypter le mot de passe.
    $passe = sha1($passe);
	$now = time();
	
	if(!empty($_FILES))
    {
    if ($_FILES['mon_fichier']['error'] == 0) 
	{
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );
    if ( in_array($extension_upload,$extensions_valides) ) 
	{
    $image_sizes = getimagesize($_FILES['mon_fichier']['tmp_name']);
    if ($image_sizes[0] > 100 OR $image_sizes[1] > 100) $erreur = "Image trop grande";
	$destination = 'image/'.$_FILES['mon_fichier']['name'];
    $resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$destination);
    }
	}
	}
	
	/* else
	{
		echo '<body onLoad="alert(\'Adresse deja utilise...\')">';
	    echo '<meta http-equiv="refresh" content="0;URL=inscrire.php">';
	} */
	
	
	$req = $conn->prepare('INSERT INTO validation(nom, prenom, User, mdp, mail, cst, url_img, created) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $req->execute(array($nom, $prenom, $pseudo, $passe, $email, $agence, $destination, $now));
	//
	echo '<body onLoad="alert(\'Demande prise en compte...\')">';
	echo '<meta http-equiv="refresh" content="0;URL=acces.php">';
	
}

else
{
    echo '<body onLoad="alert(\'Vos mots de passe sont differents...\')">';
	echo '<meta http-equiv="refresh" content="0;URL=inscrire.php">';
}

}



?>
