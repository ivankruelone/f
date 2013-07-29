<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo TITULO_WEB;?></title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width" />

        <link rel="stylesheet" href="<?php echo base_url();?>fenix2/css/bootstrap.css" />
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url();?>fenix2/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>fenix2/css/main.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>fullcalendar-1.5.4/fullcalendar/fullcalendar.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>fullcalendar-1.5.4/fullcalendar/fullcalendar.print.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>jquery-ui/css/redmond/jquery-ui-1.9.2.custom.min.css" />

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

<?php
	$this->load->view('menu2');
?>
        <div class="container">
<?php
    if(isset($vista)){
        $this->load->view($vista);
    }else{
        $this->load->view('sitio2/checador/ejemplo');
    }
	
?>
            <hr />

<?php
	$this->load->view('footer2');
?>
        </div> <!-- /container -->

        <script src="<?php echo base_url();?>fenix2/js/vendor/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url();?>jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.core.min.js"></script>
        <script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.widget.min.js"></script>
        <script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.datepicker.min.js"></script>
        
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false"></script>


        <script src="<?php echo base_url();?>fenix2/js/vendor/bootstrap.min.js"></script>

        <script src="<?php echo base_url();?>fenix2/js/plugins.js"></script>
        <script src="<?php echo base_url();?>fenix2/js/main.js"></script>
        <script src="<?php echo base_url();?>fullcalendar-1.5.4/fullcalendar/fullcalendar.min.js"></script>

        <script src="<?php echo base_url();?>fenix2/js/hc/highcharts.js"></script>
        <script src="<?php echo base_url();?>fenix2/js/hc/modules/exporting.js"></script>


        <!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        --->
    
    <?php 
    
    if(isset($js)){
        $this->load->view($js);
    }
    
    ?>
    
    </body>
</html>
