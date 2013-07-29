

            
            


<?php
    	$atributos = array('id' => 'memo');
        echo form_open('sucursales/imprime2', $atributos);
	
?>

<div align="center">
                
                <h4>Llena el Formato: </h4>
                
                <table>
                <tr>
                <td>Atenci&oacute;n: <br /><?php echo form_dropdown('atencion', $atencion, '', 'id="atencion"') ;?> </td>
                </tr>
                <tr>
                <td>Sucursal: <br /><?php echo form_dropdown('sucursal', $sucursal, '', 'id="sucursal"') ;?> </td>
                </tr>
                <tr>
                	<td><input type="submit" name="submit" value="Generar" class="btn"/></td>
                </tr>
                </table>
                
                </div>
                
<?php
	echo form_close();
    
    
?>                
         
                
                
                
                </div>