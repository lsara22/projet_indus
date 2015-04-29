<?php /* 
if(isset($_SESSION['utilisateur']) && $_SESSION['natureUser'] = 1 )
	{
		header('Location: menu.php');
	}
if(isset($_SESSION['utilisateur']) && $_SESSION['natureUser'] = 0 )
	{
		header('Location: menuUser.php');
	}	
{
    $informations = Array(//Membre qui essaie de se connecter alors qu'il l'est déjà
                    true,
                    'Vous êtes déjà connecté',
                    'Vous êtes déjà connecté avec le pseudo <span class="pseudo">'.htmlspecialchars($_SESSION['membre_pseudo'], ENT_QUOTES).'</span>.',
                    );
					exit();
}*/
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

<section id="presentation">
<h2>Présentation</h2>

<div id="texte">
       <p class="titre_paragraphe"><B>BIENVENUE:</B></p><br/>
	   <img src="uimm_foto.jpg" class="imageflottante" alt="Image flottante" />
</div> 
</section>

<section id="connexion">
<h2>Se connecter</h2>
<fieldset>
    <form action="acces1.php" method="post">
        <p>
		<label for="user">*Utilisateur:</label><input type="text" name="user" id="user"  required /><br /><br />
		
        <label for="mdp">*Mot de passe:</label><input type="password" name="mdp" id="mdp" required/><br />
</fieldset>
		      
		<input type="submit" value="connexion" />
		</p>
    </form>
	<a href="inscrire.php" >s'inscrire</a>
</section>
<div id="footer">
      <p><B>Copyright IDEE4 - Tous droits réservés.</B>
</div>


</BODY>

</HTML>
