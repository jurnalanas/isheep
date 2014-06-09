<?php require_once('Connections/sispak.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
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

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "inspeksi.php";
  $MM_redirectLoginFailed = "login-sukses.php?ref=gagal";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_sispak, $sispak);
  
  $LoginRS__query=sprintf("SELECT username, password FROM `user` WHERE username=%s AND password=%s",
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



<div class="row">
<div class="col-lg-12">
	<div class="col-lg-8">
	<div class="panel panel-info" >
		<div class="panel-heading">
		<h5 class="panel-title" style="font-size: 31px;">Domba Sehat, Daging Nikmat!</h5>
		</div>
		<div class="panel-body">
    <div class="col-lg-6">
       <div class="list">
          <div>
            <em class="icon icon-ok">
            </em>
            <h4>
              Inspeksi Kesehatan Domba
            </h4>
            <div class="section">
              Periksa kesehatan dan mencegah terjangkitnya penyakit Botulism dan Tetanus pada domba.
            </div>
          </div>
        </div>
    </div>
     <div class="col-lg-6">
       <div class="list">
          <div>
            <em class="icon icon-ok">
            </em>
            <h4>
              Pelaporan Efektif
            </h4>
            <div class="section">
              Ukur dan bandingkan kesehatan domba anda secara berkelanjutan.
            </div>
          </div>

        </div>
    </div>
    <br><hr>
         <div class="quote">
          <i class="icon-quote-left">
          </i>
          <div>
            <span class="section">iSheep membantu saya dan domba saya menjadi lebih sehat. Highly recommended.</span>
            <i class="icon-quote-right">
            </i>
          </div>
          <small class="section">by Peternak Terkenal</small>
        </div>  
		</div>
		</div>
	</div>
	<div class="col-lg-4">
			<?php if (((isset($_SESSION['MM_Username'])))):?>

      <div class="panel panel-success" style="height: 285px;" >
      <div class="panel-heading"><h3 class="panel-title"><strong style="font-size: 28px;">Selamat datang, <?php echo $_SESSION['MM_Username']; ?>! </strong></h3></div>
      <div class="panel-body">
   
      


    </div>
  </div>  <!-- panel selesai -->
      <?php else: ?>
<div class="panel panel-success" style="height:100%;" >
      <div class="panel-heading"><h3 class="panel-title"><strong style="font-size: 31px;">Sign in </strong></h3></div>
      <div class="panel-body">
       <form ACTION="<?php echo $loginFormAction; ?>" role="form" name="login" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <span id="sprytextfield1">
        <input type="text" class="form-control" style="border-radius:0px" id="username" name="username" placeholder="Username">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <span id="sprypassword">
        <input type="password" class="form-control" style="border-radius:0px" id="password" name="password" placeholder="Password">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  

      </div>
      <button type="submit" class="btn btn-info">Sign in</button>
      <a class="pull-right btn btn-default" href="register.php">Daftar &raquo;</a>
    </form>
<br>
        <p class="well well-sm">Untuk demo, gunakan akun: username:<strong>demo</strong>, password: <strong>demo</strong>.</p> 

    </div>
  </div>  <!-- panel selesai -->
      <?php endif ?>
         
<br>


	</div>
	</div>
</div>
	<script>
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    var sprypassword = new Spry.Widget.ValidationTextField("sprypassword");
    </script>
<?php include 'inc/footer2.php'; ?>