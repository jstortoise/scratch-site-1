<?php
	$content = $_REQUEST['content'];
	if (!isset($content)) {
		$content = 'Invalid Username or Password';
	}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Point of Sale System</title>
 
        <link rel="stylesheet" href="css/style.css">

<body>
    <div class="login-page">
  <div class="form">
    <form class="login-form" action = "login.php">
	    <p class="message"><?php echo $content;?></p><br><br>
		<button>Go To Login</button>
    </form>
  </div>
</div> 
    
  </body>
        
</html>
