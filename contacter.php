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
	<link rel="stylesheet" type="text/css" href="css/style1.css">
    <title>contacter</title>
</head>

<body>


<form action="newsletter.php" method="post">
	    <p>
			<fieldset>
				<legend>Newsletters</legend>
 
				sujet:<input type="text" name="sujet" id="sujet" required/><br />

                message:<textarea name="message" id="message"></textarea>
				<input type="submit" value="Envoyer" name="Envoyer" />
 
			</fieldset>
	    </p>
</form>
        
</BODY>

</HTML>
