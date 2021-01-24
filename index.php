<!DOCTYPE html>
<html lang="en">
	<head>
		<title>HOME PAGE</title>
		<style>
			.carousel-inner img{
			width: 100%;
				height: 664px;
			}
			.centered{
				position: absolute;
				bottom: 620%;
				left: 50%;
				width: 100%;
				transform: translate(-50%, -50%);
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
	</head>
	<body>
		<!-- Header Part -->
		<header>
			<nav class="navbar navbar-expand-sm bg-dark text-dark">
				<!-- Brand -->
				<a class="navbar-brand" href="index.php"><img class="float-left mr-3" src="images/sis.png" width="10%" alt="Brand Image"><p class="pt-3 pl-5 text-white">Student Information System</p></a>
				<!-- Links -->
				<ul class="nav nav-pills ml-auto ">
					<li class="nav-item ">
						<a class="nav-link text-white active" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="login.php">Login</a>
					</li>
					<!-- Dropdown -->
					<li class="nav-item dropdown ">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
							Register As
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item " href="student_regis.php">Student</a>
							<a class="dropdown-item" href="teacher_regis.php">Teacher</a>
							<a class="dropdown-item" href="parent_regis.php">Parent</a>
						</div>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Home Page Part -->
		<div id="demo" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-slide-to="0" class="active"></li>
				<li data-slide-to="1"></li>
				<li data-slide-to="2"></li>
			</ul>
			
			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/background1.jpg" alt="photo with pencels">
					<div class="carousel-caption">
						<h3 class="display-1 centered font-weight-bold">SIS</h3>
						<p class="centered">"SIS is all about information of admitted students with respects to their Teachers and Parents"</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/background2.jpg" alt="books" >
					<div class="carousel-caption">
						<h3 class="display-1 centered font-weight-bold">Nelson Mandela</h3>
						<p class="centered">"Education is the most powerfull weapon which can use to change the world"</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/background3.jpg" alt="books" >
					<div class="carousel-caption">
						<h3 class="display-1 centered font-weight-bold ">Marian Wright Edelman</h3>
						<p class="centered ">"Education is for improving the lives of others and for leaving your community and world better than you found it"</p>
					</div>
				</div>
			</div>
			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>