<div align="center">

<?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
            $ip_address = $this->session->userdata('ip_address');
            $nivel = $this->session->userdata('nivel');
            
            if($nivel == 24){
           
  
	echo anchor('a_surtido/nuevo_empleado', 'AGREGAR UN NUEVO EMPLEADO', 'class="button-link green"')
?>

 <?php
	
    }
?>

<?php
	if(isset($id)){
?>
<div align="center">
<p class="message-box ok">Sus cambios se guardaron con exito. <br />Se agrego el Id. <?php echo $id;?></p>
</div>
<?php
	}
?>

  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     
  </blockquote>
  
    
<?php echo $tabla;?>
</div>
