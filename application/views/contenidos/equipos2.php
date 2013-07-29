

<div align="center">
<?php
    $atributos = array('id' => '#nuevo_equipo');
	echo form_open('equipos/submit_nuevo_equipo', 'id="equipos"');
     
    $data_celular = array(
              'name'        => 'celular',
              'id'          => 'celular',
              'size'        => '30',
              'type'        => 'number',
              'autofocus'   => 'autofocus',
      
            );
    
    $data_modelo = array(
              'name'        => 'modelo',
              'id'          => 'modelo',
              'size'        => '30',
              'type'        => 'text',
     
            );
            
     $data_imei = array(
              'name'        => 'imei',
              'id'          => 'imei',
              'size'        => '30',
              'type'        => 'text',
     
            );
            
     $data_iccid = array(
              'name'        => 'iccid',
              'id'          => 'iccid',
              'size'        => '30',
              'type'        => 'text',
     
            );
    
    $data_fijo = array(
              'name'        => 'fijo',
              'id'          => 'fijo',
              'size'        => '30',
              'type'        => 'text'
            );
    
    $data_extension = array(
              'name'        => 'extension',
              'id'          => 'extension',
              'size'        => '30',
              'type'        => 'text'
            );
            
    $data_correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'size'        => '30',
              'type'        => 'text'
            );
    

?>
<table>
<th colspan="2" align="center">AGREGAR UN EQUIPO</th>
<tr>
	<td align="left" ><font size="+1"><strong>Tipo de Equipo: </strong></font></td>
	<td align="left"><?php echo form_dropdown('equipo', $equipo, '', 'id="equipo"') ;?> </td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Celular: </strong></font></td>
    <td align="left"> <?php echo form_input($data_celular, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Modelo: </strong></font></td>
    <td align="left"> <?php echo form_input($data_modelo, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>IMEI: </strong></font></td>
    <td align="left"> <?php echo form_input($data_imei, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>ICCID: </strong></font></td>
    <td align="left"> <?php echo form_input($data_iccid, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Tel. Fijo: </strong></font></td>
    <td align="left"> <?php echo form_input($data_fijo, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Extension voz ip: </strong></font></td>
    <td align="left"> <?php echo form_input($data_extension, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Correo: </strong></font></td>
    <td align="left"> <?php echo form_input($data_correo, "");?></td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Empleado: </strong></font></td>
	<td align="left"><?php echo form_dropdown('empleado', $empleado, '', 'id="empleado"') ;?> </td>
</tr>

</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>

<script language="javascript" type="text/javascript">

        $('#nuevo_equipo').submit(function() {
            
            
            var equipo = $('#equipo').attr("value");
            var data_celular = $('#celular').attr("value");
            var data_modelo = $('#modelo').attr("value");
            var data_imei = $('#imei').attr("value");
            var data_iccid = $('#iccid').attr("value");
            var data_fijo = $('#fijo').attr("value");
            var data_extension = $('#extension').attr("value");
            var data_correo = $('#correo').attr("value");
            var empleado = $('#empleado').attr("value");
            
            
            
            
    	  if(equipo == 1 || equipo == 2){
    	   
            if(data_celular.length == 10 && data_modelo.length >= 3 && empleado > 0 && data_imei.length >= 15 && data_iccid.length >= 20){
                
                if(confirm("Seguro que los datos son correctos ?")){
                    return true;
                }else{
                    return false;
                }
                
            }else{
                return false;
            }
    	    

    	    
    	  }else if(equipo == 4){
    	   
           if(data_extension.length == 3 && empleado > 0){
    	   
           if(confirm("Seguro que los datos son correctos ?")){
                    return true;
                }else{
                    return false;
                }
                
           }else{
                return false;
            }

    	  }else{


    	    return false    
    	   
    	  }
    	}); 


</script>
</div>