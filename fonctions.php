<?php

/*include_once 'config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Attribue un nom de session
    $secure = SECURE;
    // Cette variable empêche Javascript d’accéder à l’id de session
    $httponly = true;
    // Force la session à n’utiliser que les cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Récupère les paramètres actuels de cookies
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Donne à la session le nom configuré plus haut
    session_name($session_name);
    session_start();            // Démarre la session PHP 
    session_regenerate_id();    // Génère une nouvelle session et efface la précédente
}



function login($email, $password, $mysqli) {
    // L’utilisation de déclarations empêche les injections SQL
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Lie "$email" aux paramètres.
        $stmt->execute();    // Exécute la déclaration.
        $stmt->store_result();
 
        // Récupère les variables dans le résultat
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // Hashe le mot de passe avec le salt unique
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Si l’utilisateur existe, le script vérifie qu’il n’est pas verrouillé
            // à cause d’essais de connexion trop répétés 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Le compte est verrouillé 
                // Envoie un email à l’utilisateur l’informant que son compte est verrouillé
                return false;
            } else {
                // Vérifie si les deux mots de passe sont les mêmes
                // Le mot de passe que l’utilisateur a donné.
                if ($db_password == $password) {
                    // Le mot de passe est correct!
                    // Récupère la chaîne user-agent de l’utilisateur
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // Protection XSS car nous pourrions conserver cette valeur
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // Protection XSS car nous pourrions conserver cette valeur
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Ouverture de session réussie.
                    return true;
                } else {
                    // Le mot de passe n’est pas correct
                    // Nous enregistrons cet essai dans la base de données
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // L’utilisateur n’existe pas.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Récupère le timestamp actuel
    $now = time();
 
    // Tous les essais de connexion sont répertoriés pour les 2 dernières heures
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts <code><pre>
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Exécute la déclaration. 
        $stmt->execute();
        $stmt->store_result();
 
        // S’il y a eu plus de 5 essais de connexion 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}


function login_check($mysqli) {
    // Vérifie que toutes les variables de session sont mises en place
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Récupère la chaîne user-agent de l’utilisateur
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Lie "$user_id" aux paramètres. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Exécute la déclaration.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Si l’utilisateur existe, récupère les variables dans le résultat
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Connecté!!!! 
                    return true;
                } else {
                    // Pas connecté 
                    return false;
                }
            } else {
                // Pas connecté 
                return false;
            }
        } else {
            // Pas connecté 
            return false;
        }
    } else {
        // Pas connecté 
        return false;
    }
}*/

function genererMDP ($longueur){
	// initialiser la variable $mdp
	$mdp = "";
 
	// Définir tout les caractères possibles dans le mot de passe, 
	// Il est possible de rajouter des voyelles ou bien des caractères spéciaux
	$possible = "12346789abcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
 
	// obtenir le nombre de caractères dans la chaîne précédente
	// cette valeur sera utilisé plus tard
	$longueurMax = strlen($possible);
 
	if ($longueur > $longueurMax) {
		$longueur = $longueurMax;
	}
 
	// initialiser le compteur
	$i = 0;
 
	// ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
	while ($i < $longueur) {
		// prendre un caractère aléatoire
		$caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
 
		// vérifier si le caractère est déjà utilisé dans $mdp
		if (!strstr($mdp, $caractere)) {
			// Si non, ajouter le caractère à $mdp et augmenter le compteur
			$mdp .= $caractere;
			$i++;
		}
	}
 
	// retourner le résultat final
	return $mdp;
}


//Vérification de l'email
function check_email ($email)
{
	//Vérifier l'adresse mail
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
		echo '<br/>Adresse email invalide !';
		exit();
	}
	//Connexion à la base de données
	try
    {
        $conn = new PDO('mysql:host=localhost;dbname=new_base;charset=utf8', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
	
	$q = $db->prepare('SELECT ID_user FROM utilisateur WHERE mail = ?');
	$q->execute(array($email));
	
	$numRows = $q->rowCount();
	if($numRows > 0)
	{
		$valide = false;
		exit();
	} 
	else 
	{
		$valide = true;
		exit();
	}
	return $valide;
}
?>
