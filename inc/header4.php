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
	
  $logoutGoTo = "./index.php";
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
	<title>iSheep</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<link href="./scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./scripts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script href="./scripts/holder.js" type="text/javascript"></script>


	<link href="./assets/stylesheet.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/style.css" rel="stylesheet" type="text/css"/>
	<script href="./scripts/hint.css" type="text/javascript"></script>


	<link href="./scripts/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
    
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
	<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
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
				<?php if (((isset($_SESSION['MM_Username'])))):?>
				
				<li><a href="./pelaporan.php">Pelaporan</a></li>
				<li><a href="./inspeksi.php">Inspeksi</a></li>
<?php endif ?>
				
				<li><a href="./the-team.php">Meet The Team</a></li>
				<?php if (((isset($_SESSION['MM_Username'])))):?>

			<li style="margin-left:183px;"><a href="">@<?php echo $_SESSION['MM_Username'] ; ?></a></li>
                <li><a href="<?php echo $logoutAction ?>" class="right" style="font-weight: bold; color: seagreen; background-color: wheat;">Logout</a></li>
<?php endif ?>
			</ul>
		</nav>
	</div>
</header>

<div class="container" style="max-width: 1109px;">
	<div class="transparent-bg"></div>
	<div id="boxed-area" class="page-content">
	