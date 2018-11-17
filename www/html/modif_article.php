             if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombreDePages;
     }
}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1    
}
$premiereEntree=(($pageActuelle-1)*$messagesParPage);

//=mysql_query('SELECT * FROM livredor ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');


                $req = "SELECT a.id,a.title,a.contente,a.image,u.username FROM article a LEFT JOIN user u ON u.id=a.author ORDER BY id DESC LIMIT $premiereEntree, $messagesParPage"; 
		$result = $bdd->query($req); 
                $ligne = $result->fetch(PDO::FETCH_ASSOC);



?>

<?php 
while($ligne){
     //Je vais afficher les messages dans des petits tableaux. C'est à vous d'adapter pour votre design...
     //De plus j'ajoute aussi un nl2br pour prendre en compte les sauts à la ligne dans le message.
     echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td><strong>Ecrit par : '.stripslashes($ligne['username']).'</strong></td>
                </tr>
                <tr>
                     <td>'.nl2br(stripslashes($ligne['contente'])).'</td>
                </tr>
            </table><br /><br />';
     
//           $ligne = $result->fetch(PDO::FETCH_ASSOC);
    //J'ai rajouté des sauts à la ligne pour espacer les messages.   
}
 
echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }	
     else //Sinon...
     {
          echo ' <a href="livredor.php?page='.$i.'">'.$i.'</a> ';
     }
}
echo '</p>';
?>     