  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'faltante_form_varias_quin');
        echo form_open('cortes/agrega_faltante_dividido', $atributos);
      $data_motivo = array(
              'name'        => 'motivo',
              'id'          => 'motivo',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '20'
            );
  $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15,2'   
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
	<td align="left" ><font size="+1"><strong>EMPLEADO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id_emp', $nuevo, '', 'id="id_emp"') ;?> </td>
 </tr>

<tr>
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_importe, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">QUINCENA: </font></td>
	<td align="left"><?php echo form_dropdown('fecpre', $fecpre, '', 'id="fecpre"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">MOTIVO: </font></td>
	<td><?php echo form_input($data_motivo, "", 'required');?></td>
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
        $("#id_emp").focus();
    });
    
    $(document).ready(function(){
    
    $('#id_emp').blur(function(){
            aaa = $('#id_emp').attr("value"); 
     });
     
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#faltante_form_varias_quin').submit(function() {
        
        
        var id_emp = $('#id_emp').attr("value");
          if(id_emp > 0 ){
    	  }else{
            alert('SELECCIONE EL EMPLEADO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>