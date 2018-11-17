<?php
session_start();
?>
<a href="index.php" class="btn">VOUS VENEZ DE VOUS CONNECTER/ ALLER LA PAGE PRINCIPAL ET SE CONNECTER (VOIR NAVBAR) CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI   CLICK ICI</a>
<?php
require_once 'db.php';

$name = $_POST["username"]; //On récupère le peuso
$password = $_POST["password"]; //On récupère le mot de passe




//echo $pseudo; 
//echo "</br>";
//echo $mdp;
if ($name && $password)
{

$verif = "SELECT * FROM user where username = '$name' and password = '$password'"; //cette requete sert a vérifier que le mot de passe et le pseudo est correct
//->fetchColumn()
                $check = $bdd->query($verif);
		if($check->rowCount() == 1){  //si le mot de passe et corect (on a trouvé une ligne [une et unique ligne car le pseudo est unique])
			
	
		
//        $ligne=$verif->fetch(PDO::FETCH_ASSOC);
//        var_dump($ligne);die('e');
$ligne = $check->fetch(PDO::FETCH_ASSOC);
//print_r($result);
//die('e');session_start(); //on démarre la session

	
	$_SESSION['loged'] = 1;		//On a cette varaible qui assure que l'on est connecté
	$_SESSION['name'] = $ligne["username"];	 //cette variable stocke le pseudo de la perssone connectée			
	$_SESSION['ID'] = $ligne["id"];  //cette variable stocke le numéro de la perssone connectée			
	
			
		}
		
		else { //si cela ne marche pas 
			
		header('Location: logout.php');
}  

                }
		
	


?>
