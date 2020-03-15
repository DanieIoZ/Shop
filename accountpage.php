<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'mydb';

	$logged = false;

	$err = [];
	$dblink = mysqli_connect($server, $user, $password, $database);
	if(!$dblink)
	{
		die('Ошибка подключения к серверу баз данных.');
	}
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if (isset($_POST['signout']))
		{
			setcookie("id", "", time() - 3600*24*30*12, "/");
		    setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
		    header("Location: accountpage.php"); 
		        exit;
		}
		if (isset($_POST['signupsub']))
		{
				$RegName = $_POST['loginInputSU'];
				$RegPass = $_POST['passwordInputSU'];

				$success = "";

			    if(strlen($RegName) < 3 or strlen($RegName) > 30)
			    {
			        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
			    }


				$q = mysqli_query($dblink, "SELECT idUser FROM users where login = '".$RegName."'");

			    if(mysqli_num_rows($q) > 0)
			    {
			        $err[] = "Пользователь с таким логином уже существует в базе данных";
			    }

			    if(count($err) == 0)
			    {
			        $password = md5(md5(trim($RegPass)));

			        mysqli_query($dblink,"INSERT INTO `users` (`idUser`, `Name`, `login`, `password`, `Money`) VALUES (NULL, 'NewUser', '".$RegName."', '".$password."', '0')");
			        $success = "Successful registration, now you can sign in";
			    }
				
		}
		else if (isset($_POST['signinsub']))
		{
			$LogName = $_POST['loginInputSI'];
			$LogPass = $_POST['passwordInputSI'];

			$query = mysqli_query($dblink,"SELECT idUser, password FROM users WHERE login='".$LogName."' LIMIT 1");
		    $data = mysqli_fetch_assoc($query);

		    if($data['password'] === md5(md5($LogPass)))
		    {
		        setcookie("id", $data['idUser'], time()+60*60*24*30, "/");
		        setcookie("hash", $data['password'], time()+60*60*24*30, "/", null, null, true);
		        header("Location: Main.php"); 
		        exit;
		    }
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account</title>
	<link rel="stylesheet" type="text/css" href="css/styles-btn.css">
	<link rel="stylesheet" type="text/css" href="css/styles-bases.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/sign.css">
</head>
<body>
	<?php include "html/header.html"; ?>
	<div class="content row container-fluid d-flex justify-content-center">
		<?php 
			if (!$logged) 
			{
				?>
					<div class="Blocks d-flex justify-content-center">
						<div class="SignItem SignUp d-flex justify-content-between flex-column align-items-center">
							<p>SIGN UP</p>
							<form class="d-flex justify-content-between flex-column" action="accountpage.php" method="POST">
								<label for="loginInputSU">Login: </label><input name="loginInputSU" type="email" class="mb-2">
								<label for="passwordInputSU">Password: </label><input name="passwordInputSU" type="password" class="mb-4">
								<div class="Button-Box d-flex justify-content-center align-items-center">
									<input name="signupsub" type="submit" class="Button-Base-a no-scaling d-flex p-0 m-0 d-flex justify-content-center" value="Sign up">
								</div>
							</form>
							<?php 	
								if ($success != "") 
								{ 
									echo '<p>'.$success.'</p>'; 
								} 
								else if (count($err) > 0)
								{ 
									print "<b>При регистрации произошли следующие ошибки:</b><br>";
									foreach($err AS $error)
								    {
								        print $error."<br>";
								    } 
								}
							?>
						</div>
						<div class="SignItem SignIn d-flex justify-content-between flex-column align-items-center">
							<p>SIGN IN</p>
							<form class="d-flex justify-content-between flex-column" action="accountpage.php" method="POST">
								<label for="loginInputSI">Login: </label><input name="loginInputSI" type="text" class="mb-2">
								<label for="passwordInputSI">Password: </label><input name="passwordInputSI" type="password" class="mb-4">
								<div class="Button-Box d-flex justify-content-center align-items-center">
									<input name="signinsub" type="submit" class="Button-Base-a no-scaling d-flex p-0 m-0 d-flex justify-content-center" value="To page">
								</div>
							</form>
						</div>
					</div>

				<?php
			}
			else 
			{
				?>
					<div class="Account-Block d-flex justify-content-between">
						<div class="InfoAndMoney d-flex justify-content-between flex-column mr-4">
							<div class="Info Account-Item mb-4">
								<div class="Info-Item Name">
									<p>Name: </p>
									<div class="NameBox" id="AccName">
										<p>Carl</p>
									</div>
								</div>
								<div class="Info-Item Login">
									<p>Login: </p>
									<div class="NameBox" id="AccLog">
										<p>CarlNe@Alexey@.sobaka</p>
									</div>
								</div>
								<div class="Info-Item Money">
									<p>Money: </p>
									<div class="NameBox" id="AccMon">
										<p>2000$</p>
									</div>
								</div>
								
							</div>
							<div class="PutMoney Account-Item">
								<form class="WhatYouNeed">
									<div class="CardNum">
										<label 
										<input id="CardNumber" name="CardNumber" type="number">
									</div>
									<div class="MonthAndYear">
										<input id="CardMonth" name="CardMonth" type="number">
										<input id="CardYear" name="CardYear" type="number">
									</div>
									<div class="CVV">
										<input id="CardCVV" name="CardCVV" type="number">
									</div>
									<div class="NameAndSurname">
										<div class="NameForMoney">
											<input id="CardName" name="CardName" type="text">
										</div>
										<div class="SurnForMoney">
											<input id="CardSurname" name="CardSurname" type="text">
										</div>
									</div>
									<div class="AcceptBtn">
										<button>
											<p>PUT MONEY</p>
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="Purchases">
							fs
						</div>
					</div>

				<?php
			} 
		?>
		

	</div>
	

	

	<footer>
		
	</footer>
</body>
</html>