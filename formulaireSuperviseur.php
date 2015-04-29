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
	if ($_SESSION['natureUser']!= 5 )
	{
		header('Location: acces.php');
	}
}
?>



<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style2.css">
    <title>Nouveau superviseur</title>
</head>

<body>

<div id="bandeau">
NOUVEAU SUPERVISEUR
</div>

<div id="formulaire">

    <a href="menuAdmin.php" ><input type="submit" value="retour"/></a>
    <form action="newsuperviseur.php" method="post">
        <p>
		
		<fieldset>
		
        <label for="nom">*Nom:</label><input type="text" name="nom" id="nom" required/><br />
		
		<label for="prenom">*Prénom:</label><input type="text" name="prenom" id="prenom" required/><br />
		
		<label for="cst">*N° CST:</label><input type="text" name="cst" id="cst" required/><br />

        <label for="Fonction">fonction:</label><input type="text" name="Fonction" id="Fonction" /><br />
				
		<label for="Mail">mail:</label><input type="email" name="Mail" id="Mail" placeholder="par ex&nbsp;: h@h.srfr" /><br />

       	</fieldset>
		
      
		<input type="submit" value="Envoyer" />
		</p>
    </form>
	(*) champs obligatoires.
</div>
	
	
<div id="footer">
      <p><B>Copyright IDEE4 - Tous droits réservés.</B>
</div>


</BODY>

</HTML>
