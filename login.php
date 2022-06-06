<?php
	session_start();
    
	if(isset($_POST['login'])){
    	$value_user= $_POST['username'];
		$value_pwd= $_POST['password'];

		require ("database.php");

	 	$sql = "SELECT utente.* FROM utente WHERE utente.mail like ? and utente.password like ?" ;
        $stmt = $db->prepare($sql);
		$stmt->bindParam(1, $value_user, PDO::FETCH_ASSOC);
        $stmt->bindParam(2, $value_pwd, PDO::FETCH_ASSOC);
        $stmt->execute();
        $num= $stmt->rowCount();
        
      	if($num >0){
        	session_start();
            $_SESSION["mail"]= $value_user;
            $_SESSION["password"]= $value_pwd;
            header("Refresh:0; url=homepage.php", true, 303);
      	}
		else{
			echo "<script>alert('ERROR! Incorrect data or unregistered user.')</script>";
		}
	}
    
    if(isset($_POST['signin'])){
    	$value_nome= $_POST['nome'];
        $value_cognome= $_POST['cognome'];
    	$value_user= $_POST['mail'];
		$value_pwd= $_POST['password'];

		require ("database.php");

	 	$sql = "insert into utente (utente, password) values ('$value_user', '$value_pwd');";
        
        $stmt = $db->prepare($sql);
        $stmt->execute();        
        header("Refresh:0; url=homepage.php", true, 303);
	}
?>

<!DOCTYPE html>
<html>
	<head>
    	<title>Scoutiamo</title>
        
        <link href="login_c.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
    	<img id="logoHome" src="gallery/icone/logo.png" alt="logo la Minaudière">
        <a href='homepage.php'><img id='indietro' src='gallery/icone/torna_home.png'></a>

    	<div id="login">
        	<h1 id="title">Accedi</h1>
		
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <input class="insert" type='text' name='username' placeholder='username' required><br><br>
              <input class="insert" type='password' name='password' placeholder='password' required><br><br>
              <input id="bottone" type='submit' name='login' value='Login'> 
              <input id="bottone" type='submit' name='signin' value='Signin'>
          </form>
        </div>
    </body>
</html>
