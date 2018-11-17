<?php
session_start();
require_once 'db.php';

$user = $_SESSION["ID"];
$ID = $_GET["annonce"];

                     $req = "SELECT author,a.id,a.title,a.contente,a.image,u.username FROM article a LEFT JOIN user u ON u.id=a.author where a.id = '$ID'"; 
//    		$req = "SELECT * FROM article where id = '$ID'"; //On selectionne l'annonce dont il est question
		$result = $bdd->query($req); 
                $ligne = $result->fetch(PDO::FETCH_ASSOC);
//                var_dump($ligne);
                
                
                if($ligne['author'] != $user){
                    
                ?>    <a href="index.php" class="btn btn-danger">Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc... RETOUR</a>   
                    <?php
                      die('');
                    
                }
                                if(isset($_POST['delete'])){
                                    
                 $req = "DELETE FROM `article` where `id` = '$ID'"; 
		$result = $bdd->query($req); 
                
                    ?> <a href="index.php" class="btn ">Vous avez supprimer cette article retour acceuil</a> <?php
                         die('');
//                $ligne = $result->fetch(PDO::FETCH_ASSOC);
                }
                


$img = null;
$contente = $_POST["contente"]; 
$titile = $_POST["title"]; 
if($_FILES["photo1"]["name"] != null){
    
    $img = $_FILES["photo1"];
    
}
//die('');

if ($img !=null && $contente && $titile) //Si tous les champs sont remplis on continue
{ 
    
    
           if($contente == null){
                     ?> <a href="post_article.php" class="btn btn-danger">contenu non renseigner</a> <?php
                         die('');

                }
                if($titile == null){
                     ?> <a href="post_article.php" class="btn btn-danger">titre non renseigner</a> <?php
                         die('');
                }
   
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
//         $allok = "INSERT INTO `article`(`title`,`contente`,`image`,`author`) VAlUES ( '$titile','$contente','$resphoto1','$user')";
         $allok = "UPDATE article SET title='$titile', contente='$contente', image='$resphoto1', author='$user' WHERE id = '$ID'";
         
         
	$bdd->query($allok); 
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
if ($contente && $titile) //Si tous les champs sont remplis on continue
{ 
           if($contente == null){
                     ?> <a href="post_article.php" class="btn btn-danger">contenu non renseigner</a> <?php
                         die('');

                }
                if($titile == null){
                     ?> <a href="post_article.php" class="btn btn-danger">titre non renseigner</a> <?php
                         die('');
                }
    
     $allok = "UPDATE article SET title='$titile', contente='$contente', author='$user' WHERE id = '$ID'";
     $bdd->query($allok); 
     echo 'Upload effectué avec succès !';
    
    
}

?>


             
<html lang="en"
					<div class="container">
						<a href="index.php" class="btn btn-dark">RETOUR AUX ARTICLES</a>

					</div>    
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
<form method='post' enctype='multipart/form-data' action="/modif_post.php?annonce=<?php echo $ligne["id"];?>" class="contact1-form validate-form" style="hiden">
    <button class="btn btn-danger" TYPE='submit' NAME='delete' VALUE='SUPPRIMER ARTICLE'>POUR SUPPRIMER CETTE ARTICLE CLIKER SUR SE BOUTON /!\ LE CLICK ENTRAINE LA SUPPRESION AUTOMATIQUE DE L'ARTICLE
</button> 

			<!--<form class="contact1-form validate-form" role="form" method="POST" action="/post_article.php">-->
				<span class="contact1-form-title">
					Votre Article  
   
                                        <!--<marquee direction="down" width="250" height="200" behavior="alternate" style="border:solid">-->
                             
				</span>

				<div class="" data-validate = "Name is required">
					<input class="input1" type="text" name="title"  id="title1" value="<?php print_r($ligne['title'])?>">
					<span class="shadow-input1"></span>
				</div>

				<div class="">
					<input class="input1" type="text" name="contente"  id="contente1"size="30" value="<?php print_r($ligne['contente'])?>">
					<span class="shadow-input1"></span>
				</div>

				<input type='file' name='photo1'>VOTRE NOUVELLE PHOTO

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn" TYPE='submit' NAME='submitgo' VALUE='Envoyer'>
					</button>
                                   
                                    
				</div>
			</form>
		</div>
	</div>





</body>
</html>
