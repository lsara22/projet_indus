<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style2.css">
    <title>Nouvelle visite</title>
</head>

<body>

<div id="bandeau">
inscription
</div>

<div id="inscription">
<form action="inscription.php" method="post" enctype="multipart/form-data">

    <label>Nom: <input type="text" name="nom" required/></label><br/>
	
	<label>Prenom: <input type="text" name="prenom" required/></label><br/>

	<label>N° CST: <input type="text" name="cst" maxlength="2" required/></label><br/>

    <label>Mot de passe: <input type="password" name="passe" required/></label><br/>

    <label>Confirmation du mot de passe: <input type="password" name="passe2" required/></label><br/>
		
    <label>Adresse e-mail: <input type="email" name="email" required/></label><br/>

	<label for="mon_fichier">IMAGE (tous formats | max. 1 Mo) :</label><br />
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <input type="file" name="mon_fichier" id="mon_fichier" /><br />
	
    <input type="submit" value="M'inscrire"/>
	
</form>
</div>


<div id="footer">
      <p><B>Copyright IDEE4 - Tous droits réservés.</B>
</div>


</BODY>

</HTML>




