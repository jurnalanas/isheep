<?php require_once('Connections/sispak.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login-sukses.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

mysql_select_db($database_sispak, $sispak);
$query_list = "SELECT * FROM nilai";
$list = mysql_query($query_list, $sispak) or die(mysql_error());
$row_list = mysql_fetch_assoc($list);
$totalRows_list = mysql_num_rows($list);

mysql_select_db($database_sispak, $sispak);
$query_idhasil = "SELECT * FROM inspeksi1 ORDER BY id DESC";
$idhasil = mysql_query($query_idhasil, $sispak) or die(mysql_error());
$row_idhasil = mysql_fetch_assoc($idhasil);
$totalRows_idhasil = mysql_num_rows($idhasil);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<?php #ngambil value dari select option, eg: $_POST['rule1']; ?>
<?php include 'inc/fungsi.php'; ?>
<?php $datetime = date_create()->format('Y-m-d H:i:s'); 
?>
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



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
	 $hasil=cf($row_idhasil['otot'],$_POST['rule1'],$row_idhasil['gerak'],$row_idhasil['kepala'],$_POST['rule2'],$_POST['rule3'],$_POST['rule4']);
	$idhasil = $row_idhasil['id'];
  $username=$_SESSION['MM_Username'];
		 
  $insertSQL = sprintf("INSERT INTO inspeksi2 (kaki, lidah, napas, kejang, date, username) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['rule1'], "int"),
                       GetSQLValueString($_POST['rule2'], "int"),
                       GetSQLValueString($_POST['rule3'], "int"),
                       GetSQLValueString($_POST['rule4'], "int"),
             GetSQLValueString($datetime, "date"),
             GetSQLValueString($username, "text"));

  mysql_select_db($database_sispak, $sispak);
  $Result1 = mysql_query($insertSQL, $sispak) or die(mysql_error());

  $insertGoTo = "inspeksi3.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



?>
<?php include 'inc/header2.php'; ?>

</header>

<div class="row">
<div class="col-lg-8">
  <div class="panel panel-warning" style="height: 100%;">
    <div class="panel-heading">
    <h5 class="panel-title" style="font-size: 31px;">Deskripsi dan Bantuan</h5>
    </div>
    <div class="panel-body">
     <div class="panel-group">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h5 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Kaki belakang menjadi kaku</a>
                            </h5>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                            <div class="col-lg-3">
                              <img src="assets/sispak/botulism/kaki-kaku.jpg" class="thumbnail" style="padding: 4px;">
                              </div>
                              Kaki bagian belakang domba yang terkena penyakit terkena penyakit botulisme ataupun tetanus secara perlahan akan mengalami kekakuan sehingga menyebabkan domba tersebut kesulitan untuk berjalan.
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h5 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Lidah Kaku</a>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
<div class="col-lg-3">
                              <img src="assets/sispak/botulism/lidah-kaku.jpg" class="thumbnail" style="padding: 4px;">
                              </div>
                              Domba yang teridentifikasi positif terkena penyakit tetanus dan botulisme akan kesulitan dalam mengunyah makanan, menelan dan mengeluarkan air liur. 
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <h5 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Sesak Nafas</a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
<div class="col-lg-3">
                              <img src="assets/sispak/botulism/sesak.jpg" class="thumbnail" style="padding: 4px;">
                              </div>
                            Domba yang terkena penyakit tetanus dan botulisme akan mengalami kesulitan dalam bernafas, biasanya nafas putus-putus dan tereengah-engah.
                            </div>
                          </div>
                        </div>
                         <div class="panel panel-warning">
                          <div class="panel-heading">
                            <h5 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Kejang-Kejang</a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
<div class="col-lg-3">
                              <img src="assets/sispak/botulism/terbaring.jpg" class="thumbnail" style="padding: 4px;">
                              </div>
                            Keadaan yang ditemukan apabila penyakit tetanus dan botulisme menyerang domba  yaitu domba mengalami kejang-kejang *seperti ayan pada manusia*
                            </div>
                          </div>
                        </div>
                      </div>
    </div>
    </div>
</div>
	<div class="col-lg-4">
		<div class="panel panel-success" >
     
  		<div class="panel-heading"><h3 class="panel-title"><strong style="font-size: 31px;">Gejala Tubuh Dalam</strong></h3></div>
  		<div class="panel-body">
  		 <form method="POST" action="<?php echo $editFormAction; ?>" name="form" role="form">
  		  <div class="form-group">
        <label for="exampleInputEmail1">Kaki belakang menjadi kaku?</label>
        <span id="sprytextfield1">
        <span class="input-group">
           <span class="input-group-addon">4</span><select name="rule1" id="rule1" class="select">
             <?php do { ?>
             <option value="<?php echo $row_list['value']?>" ><?php echo $row_list['nilai'] ?></option>
             <?php } while ($row_list = mysql_fetch_assoc($list));
              $rows = mysql_num_rows($list);
              if($rows > 0) {
                  mysql_data_seek($list, 0);
	              $row_list = mysql_fetch_assoc($list); } ?>
           </select>
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
        </span>    
      </div> <!-- Selesei rule -->

<div class="form-group">
        <label for="exampleInputEmail1">Lidah kaku (tidak dapat mengunyah, menelan, dan mengeluarkan air liur)?</label>
        <span id="sprytextfield2">
        <span class="input-group">
           <span class="input-group-addon">5</span><select name="rule2" id="rule2" class="select">
             <?php do { ?>
             <option value="<?php echo $row_list['value']?>" ><?php echo $row_list['nilai'] ?></option>
             <?php } while ($row_list = mysql_fetch_assoc($list));
              $rows = mysql_num_rows($list);
              if($rows > 0) {
                  mysql_data_seek($list, 0);
                $row_list = mysql_fetch_assoc($list); } ?>
           </select>
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
        </span>    
      </div> <!-- Selesei rule -->
      <div class="form-group">
        <label for="exampleInputEmail1">Sesak Nafas</label>
        <span id="sprytextfield3">
        <span class="input-group">
           <span class="input-group-addon">6</span><select name="rule3" id="rule3" class="select">
             <?php do { ?>
             <option value="<?php echo $row_list['value']?>" ><?php echo $row_list['nilai'] ?></option>
             <?php } while ($row_list = mysql_fetch_assoc($list));
              $rows = mysql_num_rows($list);
              if($rows > 0) {
                  mysql_data_seek($list, 0);
                $row_list = mysql_fetch_assoc($list); } ?>
           </select>
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span>  
        </span>    
      </div> <!-- Selesei rule -->
      <div class="form-group">
        <label for="exampleInputEmail1">Kejang-kejang</label>
        <span id="sprytextfield4">
        <span class="input-group">
           <span class="input-group-addon">7</span><select name="rule4" id="rule4" class="select">
             <?php do { ?>
             <option value="<?php echo $row_list['value']?>" ><?php echo $row_list['nilai'] ?></option>
             <?php } while ($row_list = mysql_fetch_assoc($list));
              $rows = mysql_num_rows($list);
              if($rows > 0) {
                  mysql_data_seek($list, 0);
                $row_list = mysql_fetch_assoc($list); } ?>
           </select>
        <span class="textfieldRequiredMsg label label-warning">Harus Diisi</span></span> 
       
        </span>    
      </div> <!-- Selesei rule -->
     
      

      
  		<button type="submit" class="btn btn-info btn-lg" style="width: 100%;">Selanjutnya &raquo;</button>
  		<input type="hidden" name="MM_insert" value="form">
         
		 </form>
  	</div>
	</div>  <!-- panel selesai -->
	</div>

</div>

	 <script>
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
    var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");

   
    </script>

<?php include 'inc/footer2.php'; ?>
<?php
mysql_free_result($list);

mysql_free_result($idhasil);?>