<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | Innovation</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<link href="./scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./scripts/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<link href="./assets/stylesheet.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/style.css" rel="stylesheet" type="text/css"/>


	<link href="./scripts/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
	<script href="./scripts/holder.js" type="text/javascript"></script>
	<script href="./scripts/hint.min.css" type="text/javascript"></script>

	
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="scripts/html5shiv.js"></script>
		<script src="scripts/respond.min.js"></script>
		<style>.container {max-width: 960px}</style>
	<![endif]-->
	<link rel="shortcut icon" href="http://jurnalanas.com/wp-content/uploads/2014/05/favicon.ico" />
</head>
<body>

<header class="navbar navbar-fixed-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<i class="icon-reorder"></i>
			</button>
			<a class="navbar-brand sitename" href="./index.php">iSheep</a>
		</div>
		<nav class="sitenav collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li><a href="./index.php">Home</a></li>
				<li class="dropdown"><a href="./landing.html" class="dropdown-toggle" data-toggle="dropdown">Landing <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="./landing1.php">Landing 1</a></li>
						<li><a href="./landing2.php">Landing 2</a></li>
					</ul>
				</li>
				<li class="dropdown"><a href="./pages.html" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="./portfolio.php">Portfolio</a></li>
						<li><a href="./portfolio-item.php">Portfolio Item</a></li>
						<li><a href="./products.php">Products</a></li>
						<li><a href="./services.php">Services</a></li>
						<li><a href="./support.php">Support</a></li>
						<li><a href="./faq.php">FAQ</a></li>
						<li><a href="./about.php">About Us</a></li>
						<li><a href="./team.php">Meet The Team</a></li>
						<li><a href="./contact.php">Contact</a></li>
					</ul>
				</li>
				<li class="dropdown"><a href="./bootstrap.html" class="dropdown-toggle" data-toggle="dropdown">Bootstrap 3 Flat UI <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="./css.html">CSS</a></li>
						<li><a href="./components.php">Components</a></li>
						<li><a href="./javascript.html">Javascript</a></li>
					</ul>
				</li>
				<li><a href="./simple.php">Simple</a></li>
                <li><a href="<?php echo $logoutAction ?>">Logout</a></li>

			</ul>
		</nav>
	</div>
</header>

<div class="container" style="max-width: 1109px;">
	<div class="transparent-bg"></div>
	<div id="boxed-area" class="page-content">