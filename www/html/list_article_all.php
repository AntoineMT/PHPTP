<?php
session_start();
require_once 'db.php';
$user = $_SESSION["ID"];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>WebMag HTML Template</title>

		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<link rel="stylesheet" href="css/font-awesome.min.css">

		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    </head>
	<body>

		<header id="header">
                    <?php require_once 'header.php';
                    
                    $req = "SELECT a.id,a.title,a.contente,a.image,u.username FROM article a LEFT JOIN user u ON u.id=a.author ORDER BY id DESC"; 
	
                    
                    
                    
		$result = $bdd->query($req); 
                $ligne = $result->fetch(PDO::FETCH_ASSOC);
//                die('');

                
                
                
                
                
                
                
//$ID = $_GET["annonce"];
//$contente = $_POST["contente"]; 
//
//                $req = "SELECT a.id,a.title,a.contente,a.image,u.username FROM article a LEFT JOIN user u ON u.id=a.author where a.id = '$ID'"; 
////    		$req = "SELECT * FROM article where id = '$ID'"; //On selectionne l'annonce dont il est question
//		$result = $bdd->query($req); 
//                $ligne = $result->fetch(PDO::FETCH_ASSOC);
                
                
                
?>

		</header>

		<div class="section">
			<div class="container">
				

				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>
					</div>

					<div class="col-md-4">
						<h2>The target Attribute</h2>
                                                
                                                
                                                
                                                 <?php 
                                                while($ligne){
                                                    echo'    
							<a class="post-img" <a href ="blog-post.php?annonce=';?> <?php echo $ligne["id"];?>"><?php print_r($ligne['title'])?>
                                                       <div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-5"><?php print_r(substr($ligne['title'],0,20))?></a>
                                                                            <span class="post-date">by <?php print_r($ligne['username'])?>
                                                                                </span>
								</div>
                                                            
								<h3 class="post-title"><?php print_r(substr($ligne['contente'],0,100));?></a></h3>
                                                                		</div>
                                                                            <?php echo'</h4>
                                                ';
    ?></a><?php
                                                    $ligne = $result->fetch(PDO::FETCH_ASSOC);
                                                }
                                                    ?>
                                        
                                        
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" <a href ="blog-post.php?annonce=<?php echo $ligne["id"];?>"><img src="./img/<?php print_r($ligne['image'])?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-5"><?php print_r(substr($ligne['title'],0,20))?></a>
                                                                        <span class="post-date">by <?php print_r($ligne['username'])?></span>
								</div>
                                                            
								<h3 class="post-title"><?php print_r(substr($ligne['contente'],0,100));?></a></h3>
							</div>
						</div>
					</div>
                                        
                                        
                                        
                                        

                                    
				</div>

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
