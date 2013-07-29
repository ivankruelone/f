  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'supervisor_form_reporta_cambio');
    echo form_open('supervisor/movimiento_reporta', $atributos);
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
 $data_folio_inca = array(
              'name'        => 'folio_inca',
              'id'          => 'folio_inca',
              'maxlength'   => '20',
              'size'        => '20'
              );
 $data_dias = array(
              'name'        => 'dias',
              'id'          => 'dias',
              'maxlength'   => '2',
              'size'        => '2'
              );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
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
	<td align="left" ><font size="+1" color="blue">FECHA DEL MOVIMIENTO SI ES FALTA COLOCA PORFAVOR LA FECHA EN QUE FALTO: </font></td>
	<td colspan="1"><?php echo form_input($data_fecha_i);?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1">OBSERVACION: </font></td>
	<td colspan="1"><?php echo form_input($data_obser);?></td>
 </tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_mov ?>" name="id_mov" id="id_mov" />
<input type="hidden" value="<?php echo $folio_inca ?>" name="folio_inca" id="folio_inca" />
<input type="hidden" value="<?php echo $causa ?>" name="causa" id="causa" />
<input type="hidden" value="<?php echo $dias ?>" name="dias" id="dias" />
<?php
	echo $tabla
?>
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nom").focus();
    });
    
    $(document).ready(function(){
    
    $('#nom').blur(function(){
            nom = $('#nom').attr("value"); 
     });
     $('#suc').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     
     
     $(function() {
		$( "#fecha_i" ).datepicker();
	});
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#supervisor_form_reporta_cambio').submit(function() {
        
        
        var suc = $('#suc').attr("value");
        var nom = $('#nom').attr("value");
       
          if(nom > 0 && suc > 0 ){
    	  }else{
           alert('CAPTURE LOS DATOS SOLICITADOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>