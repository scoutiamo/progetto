<!DOCTYPE html>
<html>
	<head>
    	<title>Scoutiamo</title>
        
        <link href="pages_c.css" rel="stylesheet" type="text/css"/>
    </head>
  
    <body>
    	<?php
			  require("database.php");
              
              $sql= "select prodotto.* from prodotto;";
              $stmt= $db->prepare($sql);
              $stmt->execute();
              $values = $stmt->fetchAll();
              $num= $stmt->rowCount();
              
              if(!empty($values)) {
              	$div= "<form method='post'><div id= 'home'>
                		<div class= 'div' id='$i'>
                           <div>
                           		<a href='homepage.php'><img id='indietro' src='gallery/icone/torna_home.png'></a>
                                
                           		<img class='img' id='img$i' src='gallery/immagini/" . $values[$_GET['id']]['immagine'] . ".png'>
                                <h1 class='nome'>" . $values[0]['nomeprodotto'] . "</h1>
                                <h2 class='prezzo'>" . $values[0]['prezzo'] . "€</h2>
                                <h2 class='nome2'>" . $values[0]['nomeprodotto'] . "</h2>
                                <h4 class='desc'>" . $values[0]['brevedescrizione'] . "</h4>
                                <p class='spec'>" . $values[0]['specifiche'] . "</p>
                                
                           		<input id='carrello' type='submit' name='invia' value='Aggiungi al carrello'>
                            </div>
                    	</div>
                      </form>";
                    
              	echo $div;
              
                if(isset($_POST['invia'])){       	
                	setcookie("prodotto".$_GET['id'],$values[$_GET['id']]["id"], time() + (86400*30));
                    header("Location: carrello.php");
                }
             }
        ?>
    </body>
</html>