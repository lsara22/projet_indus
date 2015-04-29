<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
if (empty($_SESSION['utilisateur']) || empty($_SESSION['mdp'])) 
{
	 header('Location: acces.php');
     exit();
}

else
{
	if ($_SESSION['natureUser'] != 0 )
	{
		header('Location: acces.php');
	}
}
?>



<!DOCTYPE html>
<HTML>

<HEAD> 
      <TITLE>  IDEE  </TITLE>
	  <link rel="stylesheet" type="text/css" href="css/style1.css">
	  <meta charset="utf-8" />
</HEAD>

<BODY>

<div id="bandeau">
U     I     M     M   :   I     D     E     E 
</div>


<div id="menu">
<nav>
    <ul>
	<li><a href="deposerFichier.php" >Nouveau fichier</a></li>
	<li><a href="Contact.php" >Contact</a></li>
	<li><a href="deconnexion.php" >Deconnexion</a></li>
	</ul>
</nav>
</div>


<div id="texte">
       <p class="titre_paragraphe"><B>BIENVENUE:</B></p><br/>
	   <img src="uimm_foto.jpg" class="imageflottante" alt="Image flottante" />
</div> 
     
<div id="footer">
      <p><B>Copyright IDEE4 - Tous droits réservés.</B>
</div>


</BODY>

</HTML>
