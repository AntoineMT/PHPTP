<?php 
session_start();
require_once 'db.php';
$user = $_SESSION["ID"];
$ID = $_GET["annonce"];
$contente = $_POST["contente"]; 

                $req = "SELECT a.id,a.title,a.contente,a.image,u.username FROM article a LEFT JOIN user u ON u.id=a.author where a.id = '$ID'"; 
//    		$req = "SELECT * FROM article where id = '$ID'"; //On selectionne l'annonce dont il est question
		$result = $bdd->query($req); 
                $ligne = $result->fetch(PDO::FETCH_ASSOC);
                
                $reqCom = "SELECT u.username, c.contente FROM commentaire c LEFT JOIN  user u ON c.username = u.id where c.article = '$ID'"; 
//    		$req = "SELECT * FROM article where id = '$ID'"; //On selectionne l'annonce dont il est question
		$resultCom = $bdd->query($reqCom); 
                $com = $resultCom->fetch(PDO::FETCH_ASSOC);
                $contente = $_POST["contente"]; 
                
                if($contente){
                        $reqCom = "INSERT INTO `commentaire`(`username`,`contente`,`article`) VAlUES ( '$user','$contente','$ID')";
                         $bdd->query($reqCom);
                    
                }
//                print_r($ligne);
//                die('e');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>WebMag HTML Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		
		<!-- Header -->
		<header id="header">
                    <?php require_once 'header.php';
?>
			
			<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('./img/<?php print_r($ligne['image'])?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category cat-2" href="category.html"><?php print_r($ligne['username'])?></a>
								<span class="post-date"></span>
							</div>
							<h1><?php print_r($ligne['title'])?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
		</header>
		<!-- /Header -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<h3><?php print_r($ligne['title'])?></h3>
								<figure class="figure-img">
									<img class="img-responsive" src="./img/<?php print_r($ligne['image'])?>" alt="">
								</figure>
								<p><?php print_r($ligne['contente'])?></p>
							</div>
                                                    <form method='post' enctype='multipart/form-data' action="blog-post.php?annonce=<?php echo $ID ;?>" class="contact1-form validate-form">
				<div class="wrap-input1 validate-input">
					<input class="input1" type="text" name="contente" placeholder="contente" id="contente"size="30">
					<span class="shadow-input1"></span>
				</div>
				<div class="container-contact1-form-btn">
					<button class="btn btn-warning" TYPE='submit' NAME='nom' VALUE='Envoyer'>AJOUTER UN COMMENTAIRE
					</button>
				</div>
			</form>
						</div>

						<!-- ad -->
						<!-- ad -->
						
						<!-- author -->
						<!-- /author -->

						<!-- comments -->
                                               <?php 
                                                while($com){
                                                    echo'    
						<div class="section-row">
							<div class="post-comments">
								<div class="media">
                                                                    <div class="media-body">
									<p>Commentaire de ======== >
                                                                    </div>
									<div class="media-body">
										<div class="media-heading">
											<h4>';?> <?php print_r($com['username'])?> <?php echo'</h4>
										</div>
										<p>';?> <?php print_r($com['contente']) ?> <?php echo'</p>
									</div>
								</div>
							</div>
						</div>
                                                ';
                                                    
                                                    $com = $resultCom->fetch(PDO::FETCH_ASSOC);
                                                }
                                                    ?>

						<!-- /comments -->
<?php
//while($ligneoffre){		//tant qu'il y a des résultats
//       //on affiche les résultats dans un tableau
//      echo" <div class = 'row'> <!-- 1ère ligne-->
//	   
//	  
//
//	   <table class = 'table-striped col-sm-11'>
//	   
//	    <td valign = 'bottom'> <a href='Details?annonce=".$ligneoffre["numed"]."'><img src='".$ligneoffre["imgrei1"]."' class='img-thumbnail col-sm-2	'</a>
//		<div class ='col-sm-6'>
//		<h1><a href='Details?annonce=".$ligneoffre["numed"]."'>".$ligneoffre["titre"]."</a></h1>
//		".$ligneoffre["categorie"]."
//		<br> ".$ligneoffre["region"]."
//		<br><br> Posté le : ".$ligneoffre["created_at"]."
//		<br> (".$ligneoffre["pro"].")
//		</div>
//		</td>
//	  
//	  <div class ='col-sm-3'>
//	   <td valign = 'bottom' align = 'right'>
//	   
//	   
//	   <h1>".$ligneoffre["prix"]."€&nbsp;&nbsp;	</h1>&nbsp;
//	 
//	   </td>
//	     </div>
//	   
//	   </table>
//	   
//	   
//	   </div> 
//	   
//	   <br> <!-- 1ère ligne-->";
//	   $ligneoffre = mysqli_fetch_assoc($checkoffre);//On change de ligne, on passe a celle d'apres
//}
	?>   
						<!-- reply -->
						
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->

						
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
