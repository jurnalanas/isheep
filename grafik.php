<?php 
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("sispakv2");

$result = mysql_query("SELECT id, botol, tetanus FROM inspeksi3");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   // print_r($row);
    $data1[] = $row[0];
    $data2[] = $row[1];
    $data3[] = $row[2];
}
 ?>
		<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            colors: ['#ED561B', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
            title: {
                text: 'Grafik Hasil Inspeksi'
            },
            credits: {
            enabled: false
            },
            xAxis: {
                title: {
                    text: "Inspeksi ke"
                },
              
                categories: [
                    <?php echo join($data1, ','); ?>
                ]
            },
            yAxis: {
                min: 0,
                max:1,
                title: {
                    text: 'Inspeksi '
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">Inspeksi ke-{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 2
                }
            },
            series: [{
                name: 'Botulism',
                data: [<?php echo join($data2, ','); ?>]
    
            },
            {
                name: 'Tetanus',
                data: [<?php echo join($data3, ','); ?>]
    
            }]
        });
    });
    

		</script>
<div id="container"></div>
<?php mysql_free_result($result); ?>
<script src="scripts/highcharts.js"></script>
<script src="scripts/exporting.js"></script>



