  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'faltante_form_3');
    echo form_open('cortes/delete_fal', $atributos);
      $data_motivo = array(
              'name'        => 'motivo',
              'id'          => 'motivo',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '20'
              
              
            );
 
 
  ?>
 
  <table>
<tr>
<th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
<th colspan="2"><?php echo $tabla;?></th>
</tr>
<tr>

 <tr>
	<td align="left" ><font size="+1"><strong>MOTIVO: </strong></font></td>
	<td><?php echo form_input($data_motivo, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" colspan="2"><font size="-1" color="red"><strong>COLOCAR EL NUMERO DE  LA BAJA DE EMPLEADO</strong></font></td>
 </tr>

 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_fal ?>" name="id_fal" id="id_fal" />
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#motivo").focus();
    });
    
    $(document).ready(function(){
        
        
        
        
        
    
    $('#motivo').change(function(){
     motivo = $('#motivo').attr("value"); 
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#faltante_form_3').submit(function() {
       motivo = $('#motivo').attr("value").length;  
  
          if(motivo > 0 ){
    	  }else{
            alert('SELECCIONE EL EMPLEADO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>