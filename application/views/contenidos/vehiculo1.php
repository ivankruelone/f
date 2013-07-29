<div align="center">
<?php      
    echo anchor('equipos/nuevo_vehiculo', 'AGREGAR UN NUEVO VEHICULO', 'class="button-link green"')
?>     

</div>
<?php
	if($id>0){
?>
<div align="center">
<p class="message-box ok">Sus cambios se guardaron con exito. <br />Se agrego el Id. <?php echo $id;?></p>
</div>
<?php
	}elseif($id=='_'){
?>
<div align="center">
<p class="message-box ok">ESTE VEHICULO YA EXISTE</p>
</div>
<?php	   
	}
?>

<div align="center">
<?php

	echo $tabla;
?>
</div>