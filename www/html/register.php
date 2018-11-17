<?php
require_once 'db.php';


$name = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

if ($name && $password && $password2)
{
    if ($password == $password2) 
{
		$verif = "SELECT COUNT(username) FROM user where username = '$name'"; 
	
		$checkRows = $bdd->query($verif)->fetchColumn(); 
		if($checkRows == 0){ 
		   
$allok = "INSERT INTO `user`(`username`,`password`) VAlUES ( '$name','$password')";
	$bdd->query($allok); 
		
		$messagee =  "Inscription Reussie"; 
		$label = "success"; 
}
else{ 
	$messagee =  "Le pseudo est deja utilise";
        $label = "success";
}
} else { 
        $messagee = "Les Mot de Passes Ne correspondent Pas ";
        $label = "success";
}
} else { 
	$messagee =  'Veuillez remplir tous les champs';
        $label = "success";
}
echo "<h2> <span class='label label-".$label."'>".$messagee."</span></h2>"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
</head>
<body>
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="/register.php">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Name</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text" name="username" class="form-control" id="username"
                               placeholder="Username" required autofocus>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put name validation error messages here -->
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Password" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Confirm Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem">
                            <i class="fa fa-repeat"></i>
                        </div>
                        <input type="password" name="password2" id="password2" class="form-control"
                               id="password-confirm" placeholder="Password" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <div class="col-xs-12 col-md-6"><input type="submit" value="S'inscrire" action="/register.php" class="btn btn-primary btn-block btn-lg" tabindex="10"></div>
            <div class="col-xs-12 col-md-6"><a href="index.php" class="btn btn-success btn-block btn-lg">Se connecter</a></div>

            </div>
        </div>
    </form>
</div>
</body>