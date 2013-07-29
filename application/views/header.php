<!DOCTYPE HTML>
<html>

<head>

<title><?php echo TITULO_WEB; ?></title>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="<?php echo DESCRIPCION_WEB; ?>" />
<meta name="keywords" content="<?php echo KEYWORDS_WEB; ?>" />
<!--<meta http-equiv="refresh" content="300" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" title="style" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.notify.css" title="style" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/start/jquery-ui-1.8.22.custom.css" title="style" />

<script src="<?php echo base_url();?>scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/jquery-ui-1.8.22.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.datepicker.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.notify.min.js"></script>
<script src="<?php echo base_url();?>media/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>scripts/html5.js"></script><!-- this is the javascript allowing html5 to run in older browsers -->
<?php
	if(isset($extraheader))
    {
        echo $extraheader;
    }
?>

</head>
<body<?php if(isset($es_mapa)){ echo " onload=\"initialize();\"";}?>>

