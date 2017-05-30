<?php
    session_start();
	ob_start();

	$url = basename($_SERVER['PHP_SELF']);
	if ($url != "index.php") {
		header("location: invalid.php?content=" . "Invalid URL");
		exit;
	}

	$user = $_SESSION['user'];
	if (!isset($_SESSION['user'])) {
		header("location: invalid.php?content=" . "Please Click Button to Login Again");
		exit;
	} else {
		$now = time(); // Checking the time now when home page starts.

		if ($now > $_SESSION['expire']) {
			session_destroy();
			header("location: invalid.php?content=" . "Your session has expired! Login here");
			exit;
		}
	}
?>