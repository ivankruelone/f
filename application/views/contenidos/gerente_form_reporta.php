  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'gerente_form_reporta');
    echo form_open('gerente/movimiento_reporta', $atributos);
 $data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'size'        => '50',
              'type'        => 'varchar',
              'required'   => 'required'
            );
 $data_fecha_i = array(
              'name'        => 'fecha_i',
              'id'          => 'fecha_i',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>CAUSA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mot', $motx, '', 'id="mot"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nom', $nomx, '', 'id="nom"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>SUCURSAL: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1" color="red">FECHA DEL MOVIMIENTO SI ES FALTA COLOCA PORFAVOR LA FECHA EN QUE FALTO: </font></td>
	<td colspan="1"><?php echo form_input($data_fecha_i);?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1">OBSERVACION: </font></td>
	<td colspan="1"><?php echo form_input($data_obser);?></td>
 </tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<?php
	echo $tabla
?>
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#mot").focus();
    });
    
    $(document).ready(function(){
    
    $('#mot').blur(function(){
            mot = $('#mot').attr("value"); 
     });
     $('#nom').blur(function(){
            nom = $('#nom').attr("value"); 
     });
     
     
     $(function() {
		$( "#fecha_i" ).datepicker();
	});
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#gerente_form_reporta').submit(function() {
        
        
        var mot = $('#mot').attr("value");
        var nom = $('#nom').attr("value");
       
          if(nom > 0 && mot > 0 ){
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>