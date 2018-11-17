<?php
session_start();
require_once 'db.php';
$img = $_FILES["photo1"]; 
$contente = $_POST["contente"]; 
$titile = $_POST["title"]; 
$user = $_SESSION["ID"];


if(isset($_POST['submitgo'])){

if($img == null){
    ?> <a href="post_article.php" class="btn btn-danger">image non renseigner</a> <?php
    die('');
}
if($contente == null){
     ?> <a href="post_article.php" class="btn btn-danger">contenu non renseigner</a> <?php
         die('');

}
if($titile == null){
     ?> <a href="post_article.php" class="btn btn-danger">titre non renseigner</a> <?php
         die('');
}
}


if ($img && $contente && $titile ) //Si tous les champs sont remplis on continue
{
   
$dossier = 'img/'; //On défini le dossier d'upload des images
$fichier = basename($_FILES['photo1']['name']);
$taille_maxi = 1000000; //Ici on a la taille maxi réglée du 1Mo
$taille = filesize($_FILES['photo1']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg'); //ici on a un tableau avec les extensions a accepter
$extension = strrchr($_FILES['photo1']['name'], '.'); 

$uploadfile = $dossier . basename($_FILES['userfile']['name']);

if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    ?> 
<a href="post_article.php" class="btn btn-danger">Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc... RETOUR</a>
    <?php
     die('');
}
if($taille>$taille_maxi) // si le fichier est trop gros
{    
        ?> 
<a href="post_article.php" class="btn btn-danger">Fichier trop gros taille la taille maximum est de 1 MO </a>
    <?php
     die('');

}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{    

     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['photo1']['tmp_name'], $dossier .date("G-i-s").$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {    
         $resphoto1 = date("G-i-s").$fichier; //on stocke l'adresse absolue
         $allok = "INSERT INTO `article`(`title`,`contente`,`image`,`author`) VAlUES ( '$titile','$contente','$resphoto1','$user')";
         
	$bdd->query($allok); 
//        var_dump($allok);die('');
          echo 'Upload effectué avec succès !';
		  $resphoto1 = "http://localhost".$foldername."/".$dossier.date("G-i-s").$fichier; //on stocke l'adresse absolue
                  $uploadsuccess = 1;
		  
     }
   else //Sinon (la fonction renvoie FALSE).
 {   

         echo 'Echec de l\'upload !';
    }
} 
else
{    echo('Le fichier est trop gros...');
     
}
    
    
    
    
}

?>

<!DOCTYPE html>

             
<html lang="en">


					<div class="container">
						<a href="index.php" class="btn btn-dark">RETOUR AUX ARTICLES</a>

					</div>    
	<title>Contact V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>

	<link rel="stylesheet" type="text/css" href="cssForm/util.css">
	<link rel="stylesheet" type="text/css" href="cssForm/main.css">
	<link rel="stylesheet" type="text/css" href="css/mycss.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="contact1">
<form method='post' enctype='multipart/form-data' action='/post_article.php' class="contact1-form validate-form">
          <marquee direction="down" width="900" height="100" behavior="alternate" style="border:solid">
          <marquee direction="down" width="900" height="50" behavior="alternate" style="border:solid">
    <B> <p marquee style="color:#FF0000">IL EST IMPORTANT DE REMPLIR TOUTES LES IFORMATIONS DU FORMULAIRE / FORMAT PHOTOS ACCEPTER  => '.png', '.gif', '.jpg', '.jpeg' TAILLE MAXIMUM 1 MO  /!\ /!\ /!\ /!\ /!\ /!\ NO RESPONSIVE /!\ /!\ NO RESPONSIVE /!\ /!\ NO RESPONSIVE /!\ /!\ NO RESPONSIVE /!\</p> </B>
        </marquee>
        </marquee>
			<!--<form class="contact1-form validate-form" role="form" method="POST" action="/post_article.php">-->
				<span class="contact1-form-title">
					Votre Article  
   
                                        <!--<marquee direction="down" width="250" height="200" behavior="alternate" style="border:solid">-->
                             
				</span>

				<div class="wrap-input1 validate-input" data-validate = "Name is required">
					<input class="input1" type="text" name="title" placeholder="title" id="title">
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input">
					<input class="input1" type="text" name="contente" placeholder="contente" id="contente"size="30">
					<span class="shadow-input1"></span>
				</div>

				<input type='file' name='photo1'>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn" TYPE='submit' NAME='submitgo' VALUE='Envoyer'>
					</button>
                                    
					
                                    
                                   
                                    
                                    
                                    
				</div>
			</form>
		</div>
	</div>





</body>
</html>
