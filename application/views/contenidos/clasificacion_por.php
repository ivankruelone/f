<!DOCTYPE HTML>
<html>
<head>
<title>FARMACIAS EL FENIX DEL CENTRO</title>
<meta charset="utf8" />
<script src="<?php echo base_url(); ?>scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>fenix2/js/hc/highcharts.js"></script>
<script src="<?php echo base_url(); ?>fenix2/js/hc/modules/exporting.js"></script>
</head>
<body>
<article id="container2" style="text-align: left; position: relative; clear: both;">

</article>
</body>

<script type="text/javascript" charset="utf-8">

$(document).ready(function() {
               
                
    $(function () {
         Highcharts.setOptions({
    		lang: {
    			numericSymbols: null
    		}
        });
        $('#container2').highcharts({
            
            chart: {
                type: 'line',
                marginRight: 50,
                marginBottom: 50
            },
            title: {
                text: [<?php echo $tit?>],
            style: {
            color: 'gray',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
            },
          
            subtitle: {
                text: '',
                x: 1
            },
            xAxis: {
                categories: [<?php echo $etiqueta?>],
                labels: { rotation: 90,
                style: {
            color: 'black',
             fontSize: '9px',
            fontFamily: 'Arial Unicode MS'

         }}
                
                
            },
            yAxis: {
                title: {
                    text: 'Porcentaje (%)'
                },
                plotBands: [{
                color: 'red',
                width: 1,
                value: [<?php echo $prome?>],
                label: {
                    text: <?php echo $promex?>,
                    align: 'right',
                    x: -10,
                    fontSize: '8px'
                }            
            }]
            },
            tooltip: {
                valueSuffix: ' % '
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                //verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 1,
                enabled: false
            },
            series: [{
                name: 'Desabasto',
                data: [<?php echo $dato?>],
                type: 'spline',
                color: '#0B0B61'
            }]
        });
    });

                
} );
</script>
</html>