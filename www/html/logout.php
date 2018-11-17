<?php
session_start(); //on démarre la session

session_destroy(); //On éfface toutes les variables de session

header('Location: index.php');   // on redirige vers l'acceuil
?>