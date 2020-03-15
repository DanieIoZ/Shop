<?php
	include 'php/connectdata.php';

	$Category = mysqli_fetch_assoc(mysqli_query($dblink, "SELECT TableName from categories_of_items where idCOI =".$_GET['Category']));
	$Query = mysqli_fetch_assoc(mysqli_query($dblink, "SELECT * FROM ".$Category['TableName']." AS base inner join (SELECT idDevs,Name as namedev from devs) as dev on base.Developer = dev.idDevs where idItem = ".$_GET['idItem']));



	$Pics = mysqli_query($dblink, "SELECT Photo FROM photos where idCOI = ".$_GET['Category']." and idItem = ".$_GET['idItem']);
	include 'php/checklogged.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $Query['Name']; ?></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles-item.css">	
	<link rel="stylesheet" type="text/css" href="css/styles-btn.css">	
	<link rel="stylesheet" type="text/css" href="css/styles-bases.css">	
	<link rel="stylesheet" href="css/owl/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
</head>
<body>
	<?php include "html/header.html"; ?>

	
	<div class="Block-1-L container-fluid row m-0 p-0 d-flex flex-column  align-items-center">
		<div class="Title mb-2 d-flex col-md-8">
			<p class="m-2"><?php echo $Query['Name']; ?></p>
		</div>
		<div class="Main col-md-8 d-flex flex-column relative p-0">
			<!-- <div class="Title d-flex justify-content-center align-items-center">
				<p class="Game-Name">
					ORI AND THE BLIND FOREST
				</p>				
			</div> -->
			
			<div class="owl-carousel owl-theme owl-loaded m-0 p-0">
				<div class="owl-stage-outer">
					<div class="owl-stage">
					<?php 
					while ($Pic = mysqli_fetch_array($Pics))
					{
						?>
				        <div class="owl-item">
				            <div class="item pic-box">
								<?php echo '<img src="'.$Pic['Photo'].'">'; ?>
							 </div>
						</div>
					<?php
					}
					?>
					</div>
				</div>
			</div>

			<div class="Right-Side d-flex flex-column">
				<div class="Cover p-3">
					<?php echo '<img src="'.$Query['Cover'].'" alt="">'; ?>
				</div>
				<div class="Short-Desc pl-3 pr-3">
					<p><?php echo substr($Query['Description'], 0, 250)."..."; ?></p>
				</div>
				<div class="Description pl-3 pr-3 flex-column d-flex justify-content-start">
					<div class="Item-Desc d-flex">
						<div class="Attributes d-flex justify-content-between align-items-start">
							<div class="Attr-Item">
								<p>Developer</p>
							</div>
						</div>
						<div class="Values d-flex flex-column align-items-start">
							<div class="Attr-Value">
								<p><?php echo $Query['namedev']; ?></p>
							</div>
						</div>
					</div>
					<div class="Item-Desc d-flex">
						<div class="Attributes d-flex justify-content-between align-items-start">
							<div class="Attr-Item">
								<p>Release Date</p>
							</div>
						</div>
						<div class="Values d-flex flex-column align-items-start">
							<div class="Attr-Value">
								<p><?php echo date('j F Y',strtotime($Query['ReleaseDate'])); ?></p>
							</div>
						</div>
					</div>

				</div>
				<div class="Buy-Button d-flex justify-content-center">
					<div class="Button-Base-B1">
						<button onclick="ToCart(<?php echo $_GET['idItem'].",".$_GET['Category']; ?>)" class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
							<p class="Button-Base-p m-0">Add to cart</p>
						</button>
					</div>
				</div>
				<!-- <div class="Hide-Button d-flex justify-content-center">
					<div class="Button-Base-B1">
						<button class="Button-Base-a relative d-flex justify-content-center align-items-center p-0 m-0" class="d-flex justify-content-center align-items-center">
							<p class="Button-Base-p m-0">Hide</p>
						</button>
					</div>
				</div> -->
			</div>
		</div>	
	</div>
	<div class="Block-2-L container-fluid d-flex justify-content-center row m-0 p-0">
		<div class="Main col-md-8 p-3">
			<div class="row-1 d-flex justify-content-between">
				<div class="Full-Description D-Block d-flex flex-column">
					<p class="Block-Title">ABOUT</p>
					<p id="Game-Desc" class="Game-Desc m-0"><?php echo substr($Query['Description'],0,460); ?></p>
				</div>
				<div class="Score d-flex flex-column">
					<!-- <div class="M-Logo">
						<img src="img/metacritic-logo.png">
					</div> -->
					<div class="Metascore mb-2 d-flex flex-column align-items-center">
						<p class="m-0">Metascore</p>
						<div class="MS-value d-flex justify-content-center align-items-center">
							<p class="m-0">88</p>
						</div>
					</div>
					<div class="User-Score d-flex flex-column align-items-center">
						<p class="m-0">User Score</p>
						<div class="US-value d-flex justify-content-center align-items-center">
							<p class="m-0">87</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row-2 d-flex justify-content-between">
				<div class="Full-Description-2">
					<p id="Game-Desc" class="Game-Desc"><?php echo substr($Query['Description'],460); ?></p>
				
				</div>
				<!-- <div class="Req-block d-flex flex-column pl-3">
					<p class="Req-block-title pb-3">System requirements</p>
					<div class="Requirements d-flex">
						<div class="Attributes d-flex flex-column align-items-start p-1">
							<div class="Attr-Item">
								<p>OS</p>
							</div>
							<div class="Attr-Item">
								<p>Processor</p>
							</div>
							<div class="Attr-Item">
								<p>RAM</p>
							</div>
							<div class="Attr-Item">
								<p>Grafic card</p>
							</div>
							<div class="Attr-Item">
								<p>Storage space</p>
							</div>
						</div>
						<div class="Values d-flex flex-column align-items-start p-1">
							<div class="Attr-Value">
								<p>Windows</p>
							</div>
							<div class="Attr-Value">
								<p>Shit</p>
							</div>
							<div class="Attr-Value">
								<p>Shit</p>
							</div>
							<div class="Attr-Value">
								<p>Shit</p>
							</div>
							<div class="Attr-Value">
								<p>Shit</p>
							</div>
						</div>
					</div>
				</div> -->
				
			</div>
		</div>	
	</div>

	<footer class="container-fluid row p-0 footer">
		<div class="Content d-flex">
			<div class="Socials">
				
			</div>
			<div class="Pages">
				
			</div>
			<div class="License">
				
			</div>
		</div>
	</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/owl.js"></script>

	<script type="text/javascript" src="js/tocart.js"></script>
	
</body>
</html>