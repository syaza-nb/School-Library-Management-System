<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library Management System</title>
	<link rel="icon" type="image/png" href="dist/img/favicon.ico">
	<link rel="stylesheet" href="dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
	<link rel="stylesheet" href="dist/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="dist/css/animate.css">
	<link rel="stylesheet" href="dist/css/main.css">
	<style>
		ul li a {
			color: #073f5f !important;
			font-weight: 600;
		}

		ul li a:hover {
			color: #073f5f;
		}

		.logo img {
			height: 60px;
			width: auto;
		}
		.slide-carousel .item p:nth-child(1) a {
	text-decoration: none;
	border-radius: 8px;
	font-size: 16px;
	text-transform: capitalize;
	background: #073f5f;
	color: #fff;
	padding: 10px 20px;
	
	-webkit-transition: ease .4s all;
    -moz-transition: ease .4s all;
    -ms-transition: ease .4s all;
    -o-transition: ease .4s all;
    transition: ease .4s all;
}
.slide-carousel .item p:nth-child(2) a{
	background: transparent;
	border: 2px solid #fff;
	border-radius: 8px;
	font-size: 16px;
	text-transform: capitalize;
	color: #fff;
	text-decoration: none;
	padding: 10px 20px;
	/*-webkit-transition: ease .4s all;
    -moz-transition: ease .4s all;
    -ms-transition: ease .4s all;
    -o-transition: ease .4s all;
    transition: ease .4s all;*/
}
.slide-carousel .item p{
    margin-right: 10px;
}
.slide-carousel .item p:nth-child(2) a:hover{
	background: #073f5f;
	border: none;
}

.slide-carousel .item p:nth-child(1) a:hover{
	background: none;
	border: 2px solid #fff;
}

	</style>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-3">
					<div class="logo">
						<img src="dist/img/5.png" alt="logo" style="height:auto; width: 55px;">
					</div>
				</div>
				<div class="col-9">
					<div class="header-right">
						<ul>
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
							<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
								<ul class="dropdown-menu">
									<li><a href="student/login.php">Student Login</a></li>
									<li><a href="teacher/login.php">Teacher Login</a></li>
								</ul>
							</li>
							<li><a href="contactus.php">Contact Us</a></li>
						</ul>		
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Slider -->
	<div class="slider">
		<div class="slide-carousel owl-carousel">
			<!-- Repeat for all slides -->
			<div class="item" style="background-image:url(dist/img/3.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/2.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/1.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/4.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/5.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/6.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item"><h2>welcome to our library</h2></div>
					<div class="this-item"><h3>we stand behind your success</h3></div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<div class="footer text-center">
		<p>&copy; All rights reserved school library</p>
	</div>			

	<script src="dist/js/jquery-2.2.4.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/fontawesome.min.js"></script>
	<script src="dist/js/owl.carousel.min.js"></script>
	<script src="dist/js/owl.animate.js"></script>
	<script src="dist/js/custom.js"></script>
</body>
</html>
