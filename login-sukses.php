<?php require_once('Connections/sispak.php'); ?>
<?php
// if (!function_exists("GetSQLValueString")) {
// function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
// {
//   if (PHP_VERSION < 6) {
//     $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
//   }

//   $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

//   switch ($theType) {
//     case "text":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;    
//     case "long":
//     case "int":
//       $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//       break;
//     case "double":
//       $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
//       break;
//     case "date":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "defined":
//       $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//       break;
//   }
//   return $theValue;
// }
// }
// }if (!function_exists("GetSQLValueString")) {
// function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
// {
//   if (PHP_VERSION < 6) {
//     $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
//   }

//   $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

//   switch ($theType) {
//     case "text":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;    
//     case "long":
//     case "int":
//       $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//       break;
//     case "double":
//       $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
//       break;
//     case "date":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "defined":
//       $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//       break;
//   }
//   return $theValue;
// }
// }
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['exampleInputEmail1'])) {
  $loginUsername=$_POST['exampleInputEmail1'];
  $password=$_POST['exampleInputPassword1'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inspeksi.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_sispak, $sispak);
  
  $LoginRS__query=sprintf("SELECT username, username FROM `user` WHERE username=%s AND username=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $sispak) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php include 'inc/header2.php'; ?>
</header>

<div class="row">
<div class="col-lg-4"></div>
	<div class="col-lg-4">
		<div class="panel panel-default login-container" >

        <?php if(isset($_GET['ref']) && $_GET['ref'] == "gagal" ): ?>
     <div class="alert alert-danger">
        <strong>Maaf!</strong> Anda belum bisa login, silahkan coba lagi.
    </div>
  <?php elseif(isset($_GET['ref']) && $_GET['ref'] == "sukses"): ?>
<div class="alert alert-success">
        <strong>Selamat!</strong> Anda sudah terdaftar, silahkan login.
    </div>
  <?php endif ?>
  		<div class="panel-heading"><h3 class="panel-title"><strong style="font-size: 31px;">Sign in </strong></h3></div>
  		<div class="panel-body">
  		 <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" role="form">
  		  <div class="form-group">
       
        <label for="exampleInputEmail1">Username</label>
        <span id="sprytextfield1">
        <input type="text" class="form-control" style="border-radius:0px" id="exampleInputEmail1" placeholder="Username">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <span id="sprypassword">
        <input type="password" class="form-control" style="border-radius:0px" id="exampleInputPassword1" placeholder="Password">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  

      </div>
  		<button type="submit" class="btn btn-info">Sign in</button>
		</form>
  	</div>
	</div>  <!-- panel selesai -->
	</div>
	<div class="col-lg-4"></div>
</div>

	 <script>
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    var sprypassword = new Spry.Widget.ValidationTextField("sprypassword");
    </script>
<?php include 'inc/footer2.php'; ?>