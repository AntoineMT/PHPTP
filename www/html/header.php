<?php
session_start();
?>
<div id="nav">
				<div id="nav-fixed">
					<div class="container">
						<div class="nav-logo">
							<a href="index.php" class="logo"><img src="./img/logo.png" alt=""></a>
						</div>

						
                                                      <?php if(isset($_SESSION['name'])){ // Cette partie du code permet, si on est connecté d'afficher le nom de la perssones connectée
			 ?> 
                                                        
                                            
                                               <ul class="nav-menu nav navbar-nav">
                                                        <li><a href="index.php">Acceuil</a></li>
                                                        <li class="cat-4"><a href="post_article.php">Desposer un article</a></li>
							<li class="cat-2"><a href="list_article.php">Modifier article</a></li>
							<li class="cat-2"><a href="list_article_all.php">Pour voir tout les articles</a></li>
                                                        </ul>
                                                        <?php
                                                       
                                                     } else{
				
                                ?>
                                                     
                                <?php
                                // sinon on propose au client de s'inscrire
			  } ?>
                                                       
							
						

						<div class="nav-btns">
                                                    
                                                    
                                                     Bienvenue<?php if(isset($_SESSION['name'])){ // Cette partie du code permet, si on est connecté d'afficher le nom de la perssones connectée
			  echo " ".$_SESSION['name'];
                          echo",<a href='logout.php'>se deconnecter</a>";
                                                     }
                          
			  else{
				echo", vous pouvez vous <a href='register.php'>Inscrire</a>";
                                ?>
                                                     <button class="aside-btn"><i class="btn btn-info"></i><label>Ou vous connecter</label></button>
                                                     
                                <?php
                                // sinon on propose au client de s'inscrire
			  }
			  ?>
                                                    
                                                    
							
							<!--<button class="search-btn"><i class="fa fa-search"></i></button>-->
							<div class="search-form">
								<input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
								<button class="search-close"><i class="fa fa-times"></i></button>
							</div>
						</div>
					</div>
				</div>

				<div id="nav-aside">
						<?php require_once 'login.php';?>
                                    <body>
    <h1>CONNEXION</h1>
    <form class="form-horizontal" role="form" method="POST" action="/login.php">
                <label for="password">Username</label>
                        <input type="text" name="username" class="form-control" id="username"
                               placeholder="Password" required>
                <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
            <div class="col-xs-12 col-md-6"><input type="submit" value="Se connecter" action="/index.php" class="btn btn-primary btn-block btn-lg" tabindex="10"></div>

    </form>
</div>
</body>
					</div>