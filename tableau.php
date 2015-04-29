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
	<link rel="stylesheet" type="text/css" href="css/style3.css">
	<title>tableau prospection</title>
</head>

<body>

<div id="bandeau">
LISTE PROSPECTION
</div>

<div id="tableau">
        <a href="menu.php" ><input type="submit" value="retour"/></a>
				
		<form action="recherche.php" method="post">

            <p>

            <input type="text" name="recherche" required/>

            <input type="submit" value="rechercher" />
			
		    </p>

        </form>
		
		
		<?php if ( isset($_POST['rechercher']) AND !empty($_POST['recherche']) ) 
		{
			header('Location: recherche.php');
		}
		
		
		
        ?>

        <?php 
               	   try
                {
	                 $bdd = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
                }
                   catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }
         
                   $reponse = $bdd->query('SELECT  * FROM prospection WHERE id_agence = "'.$_SESSION['id_agence'].'" ORDER BY ID');
        ?>
         
        <table BORDER>
                <tr>
				    <th></th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Nature</th>
                    <th>PME</th>
                    <th>Entreprise</th>
                    <th>Contact</th>
                    <th>Fonction</th>
					<th>Telephone</th>
                    <th>Mail</th>
					<th>commentaire</th>
					<th>Ajouté par</th>
                </tr>
				
            <?php
            while ($donnees = $reponse->fetch())
            {
            ?>
                <tr>
			<td><form method="post"><INPUT type="checkbox" name="choix[]" value="true" ></td>
				    <td><?php echo htmlspecialchars($donnees['ID']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['Date']); ?></td>
					<td><?php echo htmlspecialchars($donnees['Nature']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['PME']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['Entreprise']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['Contact']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['Fonction']); ?></td>
                    <td><?php echo htmlspecialchars($donnees['Telephone']); ?></td>
					<td><?php echo htmlspecialchars($donnees['Mail']); ?></td>
					<td><?php echo htmlspecialchars($donnees['commentaire']); ?></td>
					<td><?php echo htmlspecialchars($donnees['prospecteur']); ?></td>
                </tr>
			
			<?php
			}


			?>
			<input type="submit" value="contacter" />
            </form>	
			<?php
			    				function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;

}
				//if ( isset($_POST['contacter']) ) 
					if(true)
		        {
					
			    $listcontact = array();
				
				$i = 0;
				$reponse = $bdd->query('SELECT  mail FROM prospection WHERE id_agence = "'.$_SESSION['id_agence'].'" ORDER BY ID');
				$donnees = $reponse->fetch();
				//while($_POST['choix[]'] == true)
					if(true)
				{ 
					$listcontact[i] = $donnees['mail'];
					$i++;
					echo $listcontact[i];
					debug_to_console( $listcontact[i] );
					
				}

				} 
				
			
			
			$reponse->closeCursor(); //deconnection de mysql
			
			?>
        </table>
</div>
    </body>
</html>
