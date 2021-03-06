<!DOCTYPE html>
<html>
	<head>
    	<title>Scoutiamo</title>
        
        <link href="home_c.css" rel="stylesheet" type="text/css"/>
    </head>

   <body>
    	<img id="iconaScout" src="gallery/icone/logo.png" alt="Logo Scoutiamo">
        
        <form action="search.php" method="post" id="form">
            <input type="text" name="email" id="emailAddress">
            <input type="submit" value="cerca" id="cerca">
        </form>
        
        <ul id="menu">           	
            <li><a href="#">Agesci</a></li>
            <li><a href="#">Cngei</a></li>
            <li><a href="#">Accessori</a></li>
            <li><a href="#">Chi siamo</a></li>
        </ul>
        
        <a href="carrello.php"> <img id="carrello" src="gallery/icone/icona_carrello.png" alt="logo carrello"> </a>
       	<a href="login.php"> <button class="button">Accedi</button> </a>
        
        <img src="gallery/immaginePrincipale.png" alt="immagine principale" id="immaginePrincipale">
         
        <div id="formVendita">
        	<p>Vuoi vendere un prodotto?<br>Di che associazione fai parte?</p>
         	<form action="vendiAgesci.php" method="get" id="formAgesci">
            	<input type="submit" value="AGESCI" class="button" id="buttonAgesci">
        	</form>
        
        	<form action="vendiCngei.php" method="get" id="formCngei">
            	<input type="submit" value="CNGEI" class="button" id="buttonCngei">
        	</form>
        </div>
                 
          <?php
          
          	  /*session_start();
              
              if(!isset(session["mail"])	echo "<a id='button'>Login</a>";
              else	echo "<a id='button'>Logout</a>";
              */
              
			  require("database.php");

              $sql= 'select id, immagine, nomeprodotto, prezzo from prodotto';
              $stmt= $db->prepare($sql);
              $stmt->execute();
              $values = $stmt->fetchAll();
              $num= $stmt->rowCount();
                
              if(!empty($values)) {
              	$div= "<form method='get'>";
            	for($i= 0; $i<$num; $i++) {
                    $div .= "<a class='div' href='pages.php?id=" . ($values[$i]['id']-1) . " '>
                    			<div>
                                	<img class='img' id='img$i' src='gallery/immagini/" . $values[$i]['immagine'] . ".png'>
                                    <h3>" . $values[$i]['nomeprodotto'] . "</h3>
                                    <p>" . $values[$i]['prezzo'] . "???</p>
                                </div>
                              </a>";
                }
                $div .= "</form>";
                echo $div;
            }
				
          ?>
          
         <script>
         	document.getElementById("carrello").onmouseover= onCarrello;
            document.getElementById("carrello").onmouseout= outCarrello;

            function onCarrello () {
                document.getElementById("carrello").src= "gallery/icone/carrelloclick.png";
                }
            function outCarrello () {
                document.getElementById("carrello").src= "gallery/icone/icona_carrello.png";
                }

        </script>
          
    </body>
</html>