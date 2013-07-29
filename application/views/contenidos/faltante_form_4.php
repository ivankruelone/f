  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'faltante_form_4');
    echo form_open('cortes/agrega_varios_faltantes', $atributos);
      $data_nomina = array(
              'name'        => 'nomx',
              'id'          => 'nomx',
              'value'       => '',
              'maxlength'   => '6',
              'size'        => '6'
            );
      $data_importe = array(
              'name'        => 'importe',
              'id'          => 'importe',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '20'
            );
          $data_fecha = array(
              'name'        => 'fechacorte',
              'id'          => 'fechacorte',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
            );
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
 <tr>
	<td align="left" ><font size="+1"><strong>SUCURSAL: </strong></font></td>
	<td align="left" colspan="3"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
 <tr>
	<td align="left" ><font size="+1"><strong>FECHA DEL CORTE: </strong></font></td>
	<td><?php echo form_input($data_fecha, "", 'required'); ?><strong>AAAA-MM-DD</strong></td>
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
	<td align="left" ><font size="+1"><strong>IMPORTE: </strong></font></td>
	<td><?php echo form_input($data_importe, "", 'required');?></td>
 </tr>

 <tr>
	<td align="left" ><font size="+1"><strong>MOTIVO: </strong></font></td>
	<td><?php echo form_input($data_motivo, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" colspan="2"><font size="-1" color="red"></font></td>
 </tr>

 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>
<tr>
<th colspan="2"><?php echo $tabla;?></th>
</tr>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#sucx").focus();
    });
    
    $(document).ready(function(){
        
        
        
    $('#fechacorte').change(function(){
     fechacorte = $('#fechacorte').attr("value"); 
   }); 
 
    $('#motivo').change(function(){
     motivo = $('#motivo').attr("value"); 
   }); 
        
        
    
 
       $('#importe').change(function(){
     importe = $('#importe').attr("value"); 
   }); 
   
/////////////////////////////////////////////////
/////////////////////////////////////////////////   
    
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
    $('#faltante_form_4').submit(function() {
        
   var importe = $('#importe').attr("value");
   var motivo = $('#motivo').attr("value").length;
  
       
          if(motivo > 5 ){
    	  }else{
            alert('SELECCIONE EL EMPLEADO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>