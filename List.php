<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'mydb';

	$dblink = mysqli_connect($server, $user, $password, $database);
	if(!$dblink)
	{
		die('Ошибка подключения к серверу баз данных.');
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$Category = $_POST['Category'];
	}
	else
	{
		die('rip');
	}

	$CatTitle;
	$CatLogo;
	$Request;
	$UpLeft;
	$UpRight;

	switch ($Category) {
		case 'game':

			break;
		case 'vrkits':
			$CatTitle = '';
			$CatLogo = '';
			$Request = "SELECT * FROM vrkits as vr inner join (select idVRDevs,name as namedev FROM vrdevs) as vrd on vr.Developer = vrd.idVRDevs";
			$UpLeft = '';
			$UpRight = '';
			break;
		case 'vr':
			
			break;
		case 'controller':

			break;
		case 'basestation':

			break;
		default:

			break;

		
	}
	if (isset($_POST['ByName']))
	{
		$CatTitle = 'Hello';
		$Request .= " where Name LIKE '%".$_POST['ByName']."%'";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop List</title>
	<link rel="stylesheet" type="text/css" href="css/styles-list.css">
	<link rel="stylesheet" type="text/css" href="css/styles-btn.css">
	<link rel="stylesheet" type="text/css" href="css/styles-bases.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="Block-1-L container-fluid row m-0 p-0 ">
		<div class="Right-Panel col-md-2 p-0 m-0">
			<!-- <div class="Account-Panel col-12 p-0 d-flex flex-column justify-content-between">
				<div class="Account-Image d-flex flex-column justify-content-between">
					<img src="img/8n3gxrQQPO0.jpg" alt="">
					<div class="Name">
							
					</div>

				</div>
				<div class="Money">
					
				</div>
			</div> -->
		</div>
		<div class="Main col-md-8 d-flex flex-column justify-content-center align-items-start">
			<div class="Title relative d-flex justify-content-between">
				<div class="List-Name d-flex justify-content-between align-items-center">
					<?php
						echo '<img class="cat-logo" src="'.$CatLogo.'" alt="">';
						echo '<p class="cat-title">';
					
							echo $CatTitle;
						?>
					</p>
				</div>
				<div class="Site-Name d-flex align-items-center">
					<p>
						VR-STORE
					</p>
				</div>
			</div>
			<div class="Upper-Panel relative d-flex justify-content-center align-items-center">
				<div class="Buttons d-flex justify-content-between align-items-center">
				        
				       <!--  <div class="Button-Base-B1">
							<a href="#" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
								<p class="Button-Base-p m-0">READ MORE</p>
							</a>
						</div> -->

						<!-- <form class="Search d-flex align-items-center justify-content-between">
							<input type="text" class="form-control m-0 search-input">
							<input type="submit" class="search-btn ml-1" value="">
						</form> -->
				</div>
			</div>
		</div>	
	</div>
	<div class="Block-2-L container-fluid row m-0 p-0">
		<div class="Right-Panel col-md-2">
			<div class="Categories">
				<form action="List.php" method="post">

					<?php echo '<input type="hidden" value="'.$Category.'" name="Category">' ?>
					<?php echo '<input type="hidden" value="'.$Request.'">' ?>
					<div class="Sorting">
						
					</div>
					<div class="By-Name">
						<input type="text" placeholder="Name" name="ByName">
					</div>
					<div class="By-Price d-flex">
						<input id="From" class="Price-Box" type="number" placeholder="From">
						<input id="To" class="Price-Box" type="number" placeholder="To">
					</div>

					<div class="Game-Categories">
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input type="checkbox">
							<p class="Cat-name">Cat</p>							
						</div>
						<div class="Cat d-flex align-items-center justify-content-between">
							<input id="cat" type="checkbox">
							<label for="cat">Cat</label>						
						</div>

					</div>	

					<select name="By-Developer" id="By-Developer">
						<option>VALVE</option>
						<option>VALVE-2</option>
						<option>VALVE-(x<4 & x>2)</option>
						<option>VALVE-4</option>

					</select>
					<input type="submit" value="Filter">
				</form>
				
			</div>
		</div>
		<div class="Main col-md-8">
			<div class="List d-flex flex-column justify-content-start align-items-center">
				<?php
					$ListQ = mysqli_query($dblink, $Request);	
					while ($ResArr = mysqli_fetch_array($ListQ))
					{

						echo '<div class="Item d-flex">
					<div class="Image-Box relative">
						<img src="';
						echo $ResArr['Cover'];
						echo '" alt="">';
						echo '</div>
					<div class="Info-Box d-flex flex-column justify-content-between">
						<div class="Upper d-flex justify-content-between">
							<div class="Title-GT">
								<div class="Title">';
						echo $ResArr['Name'];
						echo '</div>';
						echo $UpLeft;
							// echo '<div class="Game-Type">';
							// echo $ResArr[''];
							// echo '</div>';	
						echo $UpRight;
						// echo '</div>
						// 	<div class="Dev-Pub d-flex flex-column justify-content-between">
						// 		<div class="Dev d-flex justify-content-between">
						// 			<p>Developer:</p>
						// 			<div class="Dev-Info">';
						
						// echo $ResArr['Developer'];
						// echo '</div>
						// 	</div>';
						// 	echo '<div class="Pub d-flex justify-content-between">
						// 			<p>Publisher:</p>
						// 			<div class="Dev-Info">';
						// echo $ResArr['Publisher'];
						// echo '</div>
						// 		</div>';
									
						echo '</div>
						</div>
						<div class="Middle d-flex justify-content-between">';
						echo $ResArr['Description'];				
						echo '</div>
						<div class="Down d-flex justify-content-between">
							<div class="Date">';
						echo date('j F Y',strtotime($ResArr['ReleaseDate']));
						echo '</div>
							<div class="Price d-flex justify-content-between">
								<p class="Cur-Price">';
						echo $ResArr['Price'];
						echo '$
								</p>
								</div>
							</div>
						</div>
					</div>';

					}

				?>
			</div>
		</div>	
	</div>
	
</body>
</html>