<?php 


$result2 = mysql_query("SELECT COUNT(inspeksi3.botol) AS `total-bot`
FROM inspeksi3
WHERE inspeksi3.botol > inspeksi3.tetanus");

while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) {
   // print_r($row);
    $data1 = $row2[0];

}

$result1 = mysql_query("SELECT COUNT(inspeksi3.tetanus) AS `total-bot`
FROM inspeksi3
WHERE inspeksi3.botol <= inspeksi3.tetanus");

while ($row1 = mysql_fetch_array($result1, MYSQL_NUM)) {
   // print_r($row);
    $data2 = $row1[0];

}
 ?>
		<!-- // <script type="text/javascript" src="scripts/jquery.min.js"></script> -->
		<script type="text/javascript">
$(function () {
    $('#container1').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        colors: ['#ED561B', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
            title: {
                text: 'Grafik Hasil Inspeksi'
            },
            credits: {
            enabled: false
            },
        title: {
            text: 'Persentase hasil inspeksi'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Tetanus',   <?php $satu=100*($data2[0]/($data1[0]+$data2[0])); echo $satu  ?>],
                ['Botulisme',   <?php $dua=100*($data1[0]/($data1[0]+$data2[0])); echo $dua  ?>]
            ]
        }]
    });
});
    

		</script>


<div id="container1"></div>

<script src="scripts/highcharts.js"></script>
<script src="scripts/exporting.js"></script>
<?php mysql_free_result($result1); 
mysql_free_result($result2); 
?>