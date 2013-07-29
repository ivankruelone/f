  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'faltante_form_varias_quin_cor');
        echo form_open('cortes/agrega_faltante_dividido_cor', $atributos);
      $data_nomina = array(
              'name'        => 'nomx',
              'id'          => 'nomx',
              'value'       => '',
              'maxlength'   => '8',
              'size'        => '8'
            );
      $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '12',
              'size'        => '12'
            );
      $data_motivo = array(
              'name'        => 'motivo',
              'id'          => 'motivo',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '15'
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
	<td align="left" ><font size="+1"><strong>NOMINA: </strong></font></td>
	<td><?php echo form_input($data_nomina, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1">EMPLEADO: </font></td>
    <td align="left">
    <select name="id_emp" id="id_emp">
    </select>
    </td>
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
 $('#nomx').change(function(){
     nomx = $('#nomx').attr("value"); 
        if(nomx > 0){
  $.post("<?php echo site_url();?>/catalogo/busca_emp/", { nomx: nomx}, function(data) {
  $("#id_emp").html(data);

  }
  );
   }
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#faltante_form_varias_quin_cor').submit(function() {
        
        
        var id_emp = $('#id_emp').attr("value");
          if(id_emp > 0 ){
    	  }else{
            alert('SELECCIONE EL EMPLEADO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>