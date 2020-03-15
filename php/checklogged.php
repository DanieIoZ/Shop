<?php 

	$logged = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if (isset($_POST['signout']))
		{
			setcookie("id", "", time() - 3600*24*30*12, "/");
		    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
		    header("Location: Main.php"); 
		        exit;
		}
	}
	if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
	{
		$query = mysqli_query($dblink, "SELECT * FROM users WHERE idUser = '".intval($_COOKIE['id'])."' LIMIT 1");
		$userdata = mysqli_fetch_assoc($query);
		$logged = true;
		if(($userdata['password'] !== $_COOKIE['hash']) or ($userdata['idUser'] !== $_COOKIE['id']))
		{
			setcookie("id", "", time() - 3600*24*30*12, "/");
		    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
		}
	}	 

?>