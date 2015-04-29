<?php  

if($_POST['choix'])
{
	$tabCheckbox = $_POST['choix'];
	
	foreach($tabCheckbox as $choix)
	{
		echo $choix;
	}			
}
else
{
	echo "rien";
}

?>
