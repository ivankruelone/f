

<div align="center">
<?php
    $atributos = array('id' => '#nuevo_vehiculo');
	echo form_open('equipos/submit_nuevo_vehiculo', 'id="vehiculo"');
     
    $data_marca = array(
              'name'        => 'marca',
              'id'          => 'marca',
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
            
     $data_anio = array(
              'name'        => 'anio',
              'id'          => 'anio',
              'size'        => '30',
              'type'        => 'number',
              
                );
              
     $data_numser = array(
              'name'        => 'numser',
              'id'          => 'numser',
              'size'        => '30',
              'type'        => 'text',
              
                );
                              
     $data_placas = array(
              'name'        => 'placas',
              'id'          => 'placas',
              'size'        => '30',
              'type'        => 'text',
     
                );
            
     $data_recibe = array(
              'name'        => 'recibe',
              'id'          => 'recibe',
              'size'        => '30',
              'type'        => 'text',
     
                );
    
    $data_entrega = array(
              'name'        => 'entrega',
              'id'          => 'entrega',
              'size'        => '30',
              'type'        => 'text'
              
                );
    
    $data_color = array(
              'name'        => 'color',
              'id'          => 'color',
              'size'        => '30',
              'type'        => 'date'
              
                );
            
    ?>
<table>
<th colspan="2" align="center">AGREGAR UN VEHICULO</th>
<tr>
	<td align="left" ><font size="+1"><strong>Marca: </strong></font></td>
    <td align="left"> <?php echo form_input($data_marca, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Modelo: </strong></font></td>
    <td align="left"> <?php echo form_input($data_modelo, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>A&ntilde;o: </strong></font></td>
    <td align="left"> <?php echo form_input($data_anio, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Numero de Serie: </strong></font></td>
    <td align="left"> <?php echo form_input($data_numser, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Placas: </strong></font></td>
    <td align="left"> <?php echo form_input($data_placas, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Recibe: </strong></font></td>
	<td align="left"><?php echo form_dropdown('empleado', $empleado, '', 'id="empleado"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Entrega: </strong></font></td>
    <td align="left"> <?php echo form_input($data_entrega, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Color: </strong></font></td>
    <td align="left"> <?php echo form_input($data_color, "");?></td>
</tr>
</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>

<script language="javascript" type="text/javascript">

        $('#nuevo_vehiculo').submit(function() {
            
            
            var vehiculo = $('#equipo').attr("value");
            var data_celular = $('#marca').attr("value");
            var data_modelo = $('#modelo').attr("value");
            var data_imei = $('#placas').attr("value");
            var data_iccid = $('#recibe').attr("value");
            var data_fijo = $('#entrega').attr("value");
            var data_extension = $('#observaciones').attr("value");
        
                
                if(confirm("Seguro que los datos son correctos ?")){
                    return true;
                }else{
                   
                return false;
            }
    	    

    	    
    	  }else if(tipo == 4){
    	   
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