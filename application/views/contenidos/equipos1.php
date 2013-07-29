<div align="center">
<?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
            $ip_address = $this->session->userdata('ip_address');
            $nivel = $this->session->userdata('nivel');
            
            if($nivel == 25){
           
  
	//echo anchor('directorio/nuevo_empleado', 'AGREGAR UN NUEVO EQUIPO O EXTENSION', 'class="button-link green"')
    echo anchor('equipos/nuevo_equipo', 'AGREGAR UN NUEVO EQUIPO O EXTENSION', 'class="button-link green"')
?>     
 <?php
	
    }
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
<p class="message-box ok">EL # DE CELULAR YA EXISTE </p>
</div>
<?php	   
	}
?>

<div align="center">
<?php

	echo $tabla;
?>
</div>