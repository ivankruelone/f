<!DOCTYPE HTML>
<html>
<head>
<title>FARMACIAS EL FENIX DEL CENTRO</title>
<meta charset="utf8" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/css/demo_table.css" title="style" />
<link rel="stylesheet" href="<?php echo base_url();?>jquery-ui/css/redmond/jquery-ui-1.9.2.custom.min.css" />
</head>
<body>
<article>
<?php
echo $tabla;
?>
</article>
<article id="container" style="text-align: left; position: relative; clear: both;">

</article>
<article id="dialog">

</article>
</body>
<script src="<?php echo base_url(); ?>scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.widget.min.js"></script>

<script src="<?php echo base_url(); ?>media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>fenix2/js/hc/highcharts.js"></script>
<script src="<?php echo base_url(); ?>fenix2/js/hc/modules/exporting.js"></script>

<script type="text/javascript" charset="utf-8">

  jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "formatted-num-pre": function ( a ) {
        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
        return parseFloat( a );
    },
 
    "formatted-num-asc": function ( a, b ) {
        return a - b;
    },
 
    "formatted-num-desc": function ( a, b ) {
        return b - a;
    }
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "num-html-pre": function ( a ) {
        var x = String(a).replace( /<[\s\S]*?>/g, "" );
        return parseFloat( x );
    },
 
    "num-html-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
 
    "num-html-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );

$(document).ready(function() {
    
    $('#tabla').dataTable({
            "aoColumns": [
                { "sSortDataType": "dom-text    ", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" },
                { "sSortDataType": "dom-text", "sType": "formatted-num" }
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                
                var ene = parseInt($("#ene").html().replace(",", "").replace(",", ""));
                var feb = parseInt($("#feb").html().replace(",", "").replace(",", ""));
                var mar = parseInt($("#mar").html().replace(",", "").replace(",", ""));
                var abr = parseInt($("#abr").html().replace(",", "").replace(",", ""));
                var may = parseInt($("#may").html().replace(",", "").replace(",", ""));
                var jun = parseInt($("#jun").html().replace(",", "").replace(",", ""));
                var jul = parseInt($("#jul").html().replace(",", "").replace(",", ""));
                var ago = parseInt($("#ago").html().replace(",", "").replace(",", ""));
                var sep = parseInt($("#sep").html().replace(",", "").replace(",", ""));
                var oct = parseInt($("#oct").html().replace(",", "").replace(",", ""));
                var nov = parseInt($("#nov").html().replace(",", "").replace(",", ""));
                var dic = parseInt($("#dic").html().replace(",", "").replace(",", ""));
                var inv = parseInt($("#inv").html().replace(",", "").replace(",", ""));
                
    $(function () {
         Highcharts.setOptions({
    		lang: {
    			numericSymbols: null
    		}
        });
        $('#container').highcharts({
            chart: {
                type: 'spline',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: [<?php echo $tit?>],
                x: -20
                
                
            },
            xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic','inv']
            },
            yAxis: {
                title: {
                    text: 'Desplazamiento (Piezas)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
                plotBands: [{
                color: 'red',
                width: 1,
                value: [inv],
                label: {
                    text: <?php echo $tit2?>,
                    align: 'right',
                    x: -10,
                    fontSize: '8px'
                }            
            }]
            },
            tooltip: {
                valueSuffix: ' Piezas'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0,
                enabled: false
            },
            series: [{
                name: 'Desplazamiento',
                color: '#0B0B61',
                data: [ene,feb,mar,abr,may,jun,jul,ago,sep,oct,nov,dic]
            }]
        });
    });

                
} );
</script>
</html>