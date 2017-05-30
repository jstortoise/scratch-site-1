<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html >

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Point of Sale System</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/style.css" rel="stylesheet">

	<style>
		img {
			max-width: 100%;
		}
	</style>
</head>

<?php
	if (isset($_POST['username']) && isset($_POST['password'])) {


			$username = $_POST['username'];
			$password = $_POST['password'];

			$connection = mysql_connect("localhost", "root", "password");
			$db = mysql_select_db("gobyteit", $connection);
			
			$query = mysql_query("select name from login where password='$password' AND username='$username'", $connection);
			$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$rowdata = mysql_fetch_row($query);
				$_SESSION['user'] = $rowdata[0];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (120 * 60); //by seconds default (30 * 60)-> 30 minutes
				mysql_close($connection);
				$_SESSION['delete']  = '0';
				header("location: index.php");
			} else {
				mysql_close($connection);
				header("Location: invalid.php");
			}
															
	} else {
?>
<body>
	<img src="img/logo.jpg"> </img>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="#" method="POST">
      <input type="text" placeholder="username" name="username"/>
      <input type="password" placeholder="password" name="password"/>
      <input type="submit" name="submit" value="Submit" />
      <p class="message">Not registered? Please Contact <a href="mailto:">Administrator</a></p>
	  <p class="message">Powered by GoByteIT</p>
    </form>
  </div>
</div>


    
    
    
  </body>
  <?php } ?> 
        
</html>
