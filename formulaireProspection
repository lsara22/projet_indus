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
    <title>Nouvelle visite</title>
</head>

<body>

<div id="bandeau">
NOUVELLE VISITE
</div>

<div id="formulaire">

    <a href="menu.php" ><input type="submit" value="retour"/></a>
    <form action="prospectionpost.php" method="post">
        <p>
		
		<fieldset>
		<label for="Date">*Date:</label><input type="text" name="Date" id="Date" placeholder="par ex&nbsp;: xxxx-xx-xx" required /><br />
		
        <label for="Nature">*nature:</label><input type="text" name="Nature" id="Nature" required/><br />
		
		Taille entreprise:<br />
        <SELECT name="PME" size="1">
        <OPTION><20
        <OPTION>entre 20 et 60
        <OPTION>>60
        </SELECT>

		<label for="Entreprise">*entreprise:</label><input type="text" name="Entreprise" id="Entreprise" required/><br />

        <label for="Contact">*contact:</label><input type="text" name="Contact" id="Contact" required/><br />

		<label for="Fonction">fonction:</label><input type="text" name="Fonction" id="Fonction" /><br />
		
		<label for="Telephone">telephone:</label><input type="text" name="Telephone" id="Telephone" placeholder="par ex&nbsp;: 755000000" /><br />
		
		<label for="Mail">mail:</label><input type="email" name="Mail" id="Mail" placeholder="par ex&nbsp;: h@h.srfr" /><br />
		
		<label for="ajout">Ajouté par:</label><input type="text" name="ajout" id="ajout" /><br />

        <label for="commentaire">commentaire:</label><textarea name="commentaire" id="commentaire"></textarea>
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
