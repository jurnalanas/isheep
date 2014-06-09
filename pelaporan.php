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

mysql_select_db($database_sispak, $sispak);
$query_lapor = "SELECT id, botol, tetanus FROM inspeksi3 ORDER BY id ASC";
$lapor = mysql_query($query_lapor, $sispak) or die(mysql_error());
$row_lapor = mysql_fetch_assoc($lapor);
$totalRows_lapor = mysql_num_rows($lapor);
?>
<?php include 'inc/header2.php'; ?>

<div class="row">
  <div class="col-lg-12" style="padding-left: 29px; padding-right: 29px;">
    <div class="panel panel-info">
    <div class="panel-heading">
    <h5 class="panel-title" style="font-size: 31px;">Grafik</h5>
    </div>
    <div class="panel-body">
    <?php include 'grafik.php'; ?>

    </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-6">
    <div class="panel panel-info" style="height: 100%;">
    <div class="panel-heading">
    <h5 class="panel-title" style="font-size: 31px;">Tabel</h5>
    </div>
    <div class="panel-body">
      <table width="100%"  class="table table-bordered table-striped table-hover" >
        <thead>
          <td><strong>id</strong></td>
          <td><strong>CF Botulisme</strong></td>
          <td><strong>CF Tetanus</strong></td>
          <td><strong>Tautan</strong></td>
        </thead>
        <?php do { ?>
          <tr>
            <td><?php echo $row_lapor['id']; ?></td>
            <td><?php echo $row_lapor['botol']; ?></td>
            <td><?php echo $row_lapor['tetanus']; ?></td>
             <td><a href="hasil.php?id=<?php echo $row_lapor['id']; ?>">Lihat</a></td>
          </tr>
          <?php } while ($row_lapor = mysql_fetch_assoc($lapor)); ?>
      </table>
    </div>
    </div>
    </div>
    <div class="col-lg-6">
    <div class="panel panel-info" style="height: 100%;">
    <div class="panel-heading">
    <h5 class="panel-title" style="font-size: 31px;">Pie</h5>
    </div>
    <div class="panel-body">
    <?php include 'pie.php' ?>
    </div>
    </div>
    </div>
  </div>
</div>

<?php
mysql_free_result($lapor);
?>