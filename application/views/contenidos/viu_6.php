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
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" }
                
               
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                

                
} );
</script>
</html>