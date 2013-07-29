<!DOCTYPE html> 
<html> 
	<head> 
	<title><?php echo TITULO_WEB;?></title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1><?php echo TITULO_WEB;?></h1>
	</div><!-- /header -->

	<div data-role="content">	
        Login
        <?php echo form_open('mobile/login_submit');?>
        <div align="center" data-theme="b">
        <label for="name">Usuario:</label>
        <br />
        <input type="text" name="usuario" id="usuario" value="" required="required" />
        <br />
        <label for="name">Password:</label>
        <br />
        <input type="password" name="password" id="password" value="" required="required" />
        <button type="submit" data-theme="b">Entrar al Sistema</button>
        </div>

        <?php echo form_close();?>
	</div><!-- /content -->

	<div data-role="footer" data-theme="b">	
		<p align="center">Sistemas</p>		
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>