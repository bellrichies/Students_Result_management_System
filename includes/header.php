<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title; ?></title>
	<link href="app_assets/assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="app_assets/style.css" />
</head>
<body>

<div class="wrapper front">
	<div class="top_navbar">
		<div class="hamburger">
			<div class="one"></div>
			<div class="two"></div>
			<div class="three"></div>
		</div>
		<div class="top_menu">
			<div class="logo">Admin Dashboard</div>
			<ul>
				<!--<li><a href="#">
					<i class="fas fa-user"></i></a></li>
				<li><a href="#">
					<i class="fas fa-bell"></i>
				</a></li>-->
				<li><a href="logout.php"> 
					<i class="fas fa-power-off"></i>
				</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="wrapper">
	<div class="sidebar">
		<ul>
			<li class="menu-item" data-menu="dashboard">
				<a href="#" class="active">
					<span class="ikon"><i class="fas fa-home"></i></span>
					<span class="desc">Home</span>
				</a>
			</li>
			<li class="menu-item" data-menu="account">
				<a href="#">
					<span class="ikon"><i class="fas fa-hand-holding-usd"></i></span>
					<span class="desc">Bursary Dept.</span>
				</a>
			</li>
			<li class="menu-item" data-menu="admission">
				<a href="#">
					<span class="ikon"><i class="fas fa-user-plus"></i></span>
					<span class="desc">Admission Dept.</span>
				</a>
			</li>
			<li class="menu-item" data-menu="academic">
				<a href="#">
					<span class="ikon"><i class="fas fa-user-plus"></i></span>
					<span class="desc">Academic Dept.</span>
				</a>
			</li>
			<li class="menu-item" data-menu="registration">
				<a href="#">
					<span class="ikon"><i class="fas fa-sim-card"></i></span>
					<span class="desc">Generate Pin</span>
				</a>
			</li>

			<li class="menu-item" data-menu="settings">
				<a href="#">
					<span class="ikon"><i class="fas fa-cogs"></i></span>
					<span class="desc">Settings</span>
				</a>
			</li>
			<li class="menu-item" data-menu="user-account">
				<a href="#">
					<span class="ikon"><i class="fas fa-user-friends"></i></span>
					<span class="desc">Users Account</span>
				</a>
			</li>
		</ul>
	</div>