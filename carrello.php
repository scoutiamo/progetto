<DOCTYPE! html>
<html>
	<head>
    	<title>Scoutiamo</title>
        
        <link href="carrello_c.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
          <a href="homepage.php"><img id="logoHome" src="gallery/icone/logo.png" alt="logo la Minaudière"></a>
            <?php
                require ("database.php");

                $sql= "select * from prodotto;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $values=$stmt->fetchAll();
                $num= $stmt->rowCount();             

                if(!empty($values)) {
                    $div= "<form method='post'>";
                    for($i= 0; $i<$num; $i++) {
                        if(isset($_COOKIE["prodotto".($i)])){
                        $div .= "<div class='div'>
                                    <img class='img' id='img$i' src='gallery/immagini/" . $values[$i]['immagine'] . ".png'>
                                    <h3>" . $values[$i]['nomeprodotto'] . "</h3>
                                    <p>" . $values[$i]['prezzo'] . "€</p>
                                    <input class='delProd' type='submit' name='delete$i' value='Elimina prodotto'>
                                 </div>";
                         }
                    }
                    $div .= "</form>";
                    echo $div;

                for($i= 0; $i<$num; $i++) {
                    if(isset($_POST["delete$i"])){
                        setcookie("prodotto$i", $values[$_GET['id']]["id"], time()-123456789);
                        header("Refresh: 0");
                    }
                  }
                }

            ?>
    </body>
</html>