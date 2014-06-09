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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "register")) {
  $insertSQL = sprintf("INSERT INTO `user` (nama, username, password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['namaLengkap'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_sispak, $sispak);
  $Result1 = mysql_query($insertSQL, $sispak) or die(mysql_error());

  $insertGoTo = "login-sukses.php?ref=sukses";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php include 'inc/header2.php'; ?>



<div class="row">
<div class="col-lg-12">
	<div class="col-lg-8">
	<div class="panel panel-warning" style="height: 285px;">
		<div class="panel-heading">
		<h5 class="panel-title" style="font-size: 31px;">Ketentuan dan Kesepakatan aplikasi iSheep</h5>
		</div>
		<div class="panel-body">
		<p><i class="icon icon-ok">
             </i>  Aplikasi ini ditunjukkan untuk kalangan peternak domba, akademisi, ataupun orang-orang yang membutuhkan informasi terkait penyakit tetanus dan botulisme pada domba ternak.</p>
             <p><i class="icon icon-ok"></i> Aplikasi ini tidak boleh disalahgunakan.</p>
             <p><i class="icon icon-ok"></i> Segala macam bentuk penyalahgunaan yang terjadi akan diproses secara hukum sebagaimana mestinya.</p>

		</div>
		</div>
	</div>
	<div class="col-lg-4">
			
         <div class="panel panel-info" >
  		<div class="panel-heading"><h3 class="panel-title"><strong style="font-size: 31px;">Daftar </strong></h3></div>
  		<div class="panel-body">
  		 <form action="<?php echo $editFormAction; ?>" name="register" role="form" method="POST" id="register">
       <div class="form-group">
        <label for="exampleInputEmail1">Nama Lengkap</label>
        <span id="namaLengkap">
        <input type="text" class="form-control" style="border-radius:0px" id="namaLengkap" name="namaLengkap" placeholder="Nama Lengkap">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
      </div>
  		<div class="form-group">
    		<label for="username">Username</label>
    		<span id="sprytextfield1">
    		<input type="text" class="form-control" style="border-radius:0px" id="username" name="username" placeholder="Username">
    		<span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
  		</div>
  		<div class="form-group">
    		<label for="exampleInputPassword1">Password</label>
        <span id="sprypassword">
    		<input type="password" name="password" class="form-control" style="border-radius:0px" id="password" placeholder="Password">
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
  		</div>
      <div class="form-group">
        <label for="exampleInputPassword1">Konfirmasi Password</label>
        <span id="konfirmpassword">
        <input type="password" class="form-control" style="border-radius:0px" id="konfirmpassword" name="konfirmpassword" placeholder="Password">
        <span class="confirmRequiredMsg label label-warning">Harus Diisi.</span><span class="confirmInvalidMsg">Password tidak cocok.</span></span></div>
        <button type="submit" class="btn btn-info">Daftar</button>
        <input type="hidden" name="MM_insert" value="register">
     
  		
		 </form>
  	</div>
	</div>  <!-- panel selesai -->
<br>


	</div>
	</div>
</div>
	<script>
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    var sprypassword = new Spry.Widget.ValidationTextField("sprypassword");
    var namaLengkap = new Spry.Widget.ValidationTextField("namaLengkap");
    var spryconfirm1 = new Spry.Widget.ValidationConfirm("konfirmpassword", "sprypassword");
    </script>
<?php include 'inc/footer2.php'; ?>