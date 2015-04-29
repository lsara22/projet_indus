<?php
include 'fonctions.php';

if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['cst']))
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

$nom = $_POST['nom'];
$conca = '.';
$prenom = $_POST['prenom'];
$conca = $conca.$prenom;
$pseudo = $nom.$conca;

$email = $_POST['Mail'];
$agence = $_POST['cst'];
$passe = genererMDP(8);
$passe2 = $passe;	
$passe = sha1($passe);
$val = 1;
$temps = NOW();

$req = $conn->prepare("INSERT INTO utilisateur(nom, prenom, User, mdp, superviseur, ID_agence, mail, created) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
$req->execute(array($nom, $prenom, $pseudo, $passe, $val, $agence, $email, $temps));


// envoi d'un mail au superviseur avec ces coordonnées.
/* $sujet = 'Vos identifiants de connexion à IDEE4'
$message = 'Bonjour Mr/Mme'.$nom.'!' ?> <br /> 
<?php 
'Email :'.$email; ?> <br />
<?php
$message .= 'login:' .$pseudo; ?> <br />
<?php
$message .= 'mot de passe:' .$passe2; ?> <br />
<?php
$message .= 'Cordialement.';

$from = "from: IDEE4 <idee4@uimm.fr>\n";
$from .= "Reply-to: \"WeaponsB\" <idee4@uimm.fr>\n";
$from .="MIME-Version: 1.0\n";
$from .= "Content-Type: text/plain; charset=utf-8\r\n";

$val_mail = $email;
mail($val_mail,$sujet,$message,$from); */
//

$to = $email;
		$from = "idee4@uimm.com";
		$subject = "UIMM - IDEE4";
		$message = "<!DOCTYPE html>
					<html>
						<head>	
							<meta charset=\"UTF-8\" />
						</head>
						<body>
							Hi '".$pseudo."' ,<br/><br/>
						    <h2>Indentifiants de connexion:</h2>  
						   <p>
								Pseudo: '".$email."'<br/> 
								Mot de passe: '".$passe2."'.<br/>
						   </p> 
						</body>
					</html>";
		$headers = "From:'".$from."'\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		if(mail($to, $subject, $message, $headers))
		{
	    echo 'register_success';
        }
echo '<body onLoad="alert(\'Superviseur ajoute...\')">';
echo '<meta http-equiv="refresh" content="0;URL=menuAdmin.php">';
}
?>
