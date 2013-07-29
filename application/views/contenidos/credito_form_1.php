  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'credito_form_1');
    echo form_open('cortes/agrega_credito', $atributos);
      $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
              
              
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
	<td align="left" ><font size="+1"><strong>Empleado: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id_emp', $id_empx, '', 'id="id_emp"') ;?> </td>
    
 </tr>

 <tr>
	<td align="left" ><font size="+1"><strong>IMPORTE: </strong></font></td>
	<td><?php echo form_input($data_importe, "", 'required');?></td>
 </tr>

 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cre ?>" name="id_cre" id="id_cre" />
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#id_emp").focus();
    });
    
    $(document).ready(function(){
        
        
        
        
        
    
    $('#id_emp').change(function(){
     id_emp = $('#id_emp').attr("value"); 
   });  
    $('#importe').change(function(){
     importe = $('#importe').attr("value"); 
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#credito_form_1').submit(function() {
        
  
          if(importe > 0 && id_emp){
    	  }else{
            alert('SELECCIONE EL EMPLEADO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>