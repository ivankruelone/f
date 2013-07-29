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
    <div data-theme="b" data-role="header">
        <h1>
            Sistemas
        </h1>
    </div>
    <div data-role="content" style="padding: 15px">
        <img src="https://maps.googleapis.com/maps/api/staticmap?center=Madison, WI&amp;zoom=14&amp;size=288x200&amp;markers=Madison, WI&amp;sensor=false"
        width="288" height="200">
    </div>
    <div data-theme="b" data-role="footer" data-position="fixed">
        <h1>
            Saludos
        </h1>
    </div>
</div>

</body>
</html>