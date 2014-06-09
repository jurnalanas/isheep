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

$colname_hasil = "-1";
if (isset($_GET['id'])) {
  $colname_hasil = $_GET['id'];
}
mysql_select_db($database_sispak, $sispak);
$query_hasil = sprintf("SELECT inspeksi1.id,   inspeksi1.otot,   inspeksi1.gerak,   inspeksi1.kepala,   inspeksi2.kaki,   inspeksi2.lidah,   inspeksi2.napas,   inspeksi2.kejang,   inspeksi2.date,   inspeksi2.username,   inspeksi3.kembung,   inspeksi3.rahang,   inspeksi3.batuk,   inspeksi3.raisa,   inspeksi3.kelopak,   inspeksi3.botol,   inspeksi3.tetanus FROM inspeksi1,      inspeksi2,      inspeksi3 WHERE inspeksi1.id = inspeksi2.id AND inspeksi2.id = inspeksi3.id AND inspeksi3.id = %s ORDER BY inspeksi1.id DESC", GetSQLValueString($colname_hasil, "int"));
$hasil = mysql_query($query_hasil, $sispak) or die(mysql_error());
$row_hasil = mysql_fetch_assoc($hasil);
$totalRows_hasil = mysql_num_rows($hasil);
?>
<?php include 'inc/header3.php'; ?>

    <div class="row">
      <div class="col-lg-12">
        <h1>Hasil CF</h1>
        <table width="100%"  class="table table-bordered table-striped table-hover" >
  <thead>
    <td width="6%"><strong>No</strong></td>
    <td width="18%"><strong>Rule</strong></td>
    <td width="21%"><strong>Bobot Botulism</strong></td>
    <td width="21%"><strong>Bobot Tetanus</strong></td>
    <td width="17%"><strong>Agregat CF Botulism</strong></td>
    <td width="17%"><strong>Agregat CF Tetanus</strong></td>
  </thead>
  <?php $workcfbotol =0; $workcftetanus=0; ?>
  <tr>
    <td>1</td>
    <td><?php if($row_hasil['otot'] == "1"){ echo "Ya"; } else { echo "Tidak"; }; ?></td>
    <td>0.9</td>
    <td>0.2</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['otot']*(0.9*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['otot']*(0.2*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>2</td>
    <td><?php if($row_hasil['kaki']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.7</td>
    <td>0.5</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['kaki']*(0.3*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['kaki']*(0.5*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>3</td>
    <td><?php if($row_hasil['gerak']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.3</td>
    <td>0.3</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['gerak']*(0.9*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['gerak']*(0.3*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>4</td>
    <td><?php if($row_hasil['kepala']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>1</td>
    <td>0.8</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['kepala']*(1*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['kepala']*(0.8*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>5</td>
    <td><?php if($row_hasil['lidah']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.4</td>
    <td>0.3</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['lidah']*(0.9*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['lidah']*(0.3*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>6</td>
    <td><?php if($row_hasil['napas']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.4</td>
    <td>0.3</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['napas']*(0.4*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['napas']*(0.3*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>7</td>
    <td><?php if($row_hasil['kejang']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.6</td>
    <td>0.6</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['kejang']*(0.6*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['kejang']*(0.6*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>8</td>
    <td><?php if($row_hasil['kembung']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.3</td>
    <td>0.6</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['kembung']*(0.3*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['kembung']*(0.6*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>9</td>
    <td><?php if($row_hasil['batuk']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.5</td>
    <td>0.5</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['batuk']*(0.5*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['batuk']*(0.5*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>10</td>
    <td><?php if($row_hasil['rahang']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.6</td>
    <td>0.7</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['rahang']*(0.6*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['rahang']*(0.7*(1-$workcftetanus)));?></td>
  </tr>
  <tr>
    <td>11</td>
    <td><?php if($row_hasil['raisa']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.4</td>
    <td>0.7</td>
    <td><?php echo $workcfbotol=$workcfbotol+($row_hasil['raisa']*(0.4*(1-$workcfbotol)));?></td>
    <td><?php echo $workcftetanus=$workcftetanus+($row_hasil['raisa']*(0.7*(1-$workcftetanus)));?></td>
  </tr>
  <tr class="success">
    <td>12</td>
    <td><?php if($row_hasil['kelopak']=="1"){ echo "Ya"; } else { echo "Tidak";}; ?></td>
    <td>0.2</td>
    <td>0.9</td>
    <?php 
    $workcfbotol=$workcfbotol+($row_hasil['kelopak']*(0.2*(1-$workcfbotol)));
    $workcftetanus=$workcftetanus+($row_hasil['kelopak']*(0.9*(1-$workcftetanus)));
     ?>
    <td class="<?php if($workcfbotol>$workcftetanus) {
      echo "danger"; 
    } else { echo "warning"; }
    ?>"><?php echo $workcfbotol;?></td>
    <td class="<?php if($workcfbotol<$workcftetanus) {
      echo "danger"; 
    } else { echo "warning"; }?>"><?php echo $workcftetanus;?></td>
  </tr>
</table>

      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-6">
        <img src="assets/sispak/tetanus/kejang.jpg" alt="" class="mg2 thumbnail" style="max-width=315px; max-height:500px;">
      </div>
      <div class="col-lg-6">
      <div class="progress">
       <?php 
    $gejala; $status;
        if ($workcfbotol > $workcftetanus) {
          if ($workcfbotol < 0.5 ) {
            $gejala = "Domba menunjukkan gejala ringan penyakit botulisme.";
            $status = "Gejala Ringan Botulism";
          } elseif ($workcfbotol < 0.8) {
            $gejala = "Domba terkena penyakit botulisme.";
            $status = "Gejala Sedang Botulism";
          } else {
            $gejala = "Domba terkena penyakit botulisme parah dan membutuhkan perawatan segera.";
            $status = "Gejala Berat Botulism";
          }
        }  else {
          if ($workcftetanus < 0.5) {
            $gejala = "Domba menunjukkan gejala ringan penyakit tetanus.";
            $status = "Gejala Ringan Tetanus";
          } elseif ($workcftetanus < 0.8) {
            $gejala = "Domba terkena penyakit tetanus.";
            $status = "Gejala Sedang Tetanus";

          } else {
            $gejala = "Domba terkena penyakit tetanus parah dan membutuhkan perawatan segera.";
            $status = "Gejala Berat Tetanus";

          }
        }
     ?>
      <?php if ($workcftetanus > $workcfbotol) {
        $besar = $workcftetanus;
        } else {
          $besar = $workcfbotol;
          $satu=$besar*100;
          } ?>
          <?php if ($besar < 0.5) : ?>
    <div class="progress-bar progress-bar-success hint--right  hint--always" data-hint="<?php echo $besar; ?>" style="width: <?php echo $besar*100; ?>%">
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (success)</span>
    <span class="label label-success"><?php echo "$satu%"; ?></span>

    </div>
  <?php elseif ($besar < 0.8) : $besar = $besar - 0.5; ?>
    <div class="progress-bar progress-bar-success" style="width: 50%">
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (danger)</span>
    </div>
    <div class="progress-bar progress-bar-warninghint--right  hint--always" data-hint="<?php echo $besar; ?>" style="width: <?php echo $besar*100; ?>%">
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (warning)</span>
    <span class="label label-warning"><?php echo "$satu%"; ?></span>

    </div>
  <?php else: $besar = $besar - 0.7; ?>
    <div class="progress-bar progress-bar-success" style="width: 50%">
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (danger)</span>
    </div>
    <div class="progress-bar progress-bar-warning" style="width: 20%">
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (danger)</span>
    </div>
    <div class="progress-bar progress-bar-danger hint--right  hint--always" data-hint="<?php echo $besar; ?>" style="width: <?php echo $besar*100; ?>%">
    <span class="label label-danger"><?php echo "$satu%"; ?></span>
    
    <span class="sr-only"><?php $besar *100; echo $besar; ?>% Complete (danger)</span>
    </div>
  <?php endif ?>
    </div>
   

        <h3 class="alert alert-danger"><?php echo $status; ?></h3>
        <p><?php echo $gejala; ?></p>
        <p><span class="label label-success">Gejala Ringan</span> <span class="label label-warning">Gejala Sedang</span> <span class="label label-danger">Gejala Berat</span></p>
      </div>
      </div>
    </div>
    <div id="sitefooter" class="row">
      <div class="col-lg-12">
        <hr>
        <p class="center">
          <small>© 2014 iSheep</small>
        </p>
      
      </div>
    </div>
  <?php include 'inc/footer.php'; ?>
<?php
mysql_free_result($hasil);
?>
