

<div align="center">
<?php
    $atributos = array('id' => '#agrega_tarjeta');
	echo form_open('ventas/submit_nueva_tarjeta', 'id="agrega_tarjeta"');
     
    $data_folio_ini = array(
              'name'        => 'inicial',
              'id'          => 'inicial',
              'size'        => '30',
              'type'        => 'number',
              'autofocus'   => 'autofocus',
      
            );
    
    $data_folio_fin = array(
              'name'        => 'final',
              'id'          => 'final',
              'size'        => '30',
              'type'        => 'text',
     
            );
            

?>
<table>
<th colspan="2" align="center">AGREGAR TARJETA </th>
<tr>
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('sucursal', $sucursal, '', 'id="sucursal"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Folio Inicial: </strong></font></td>
    <td align="left"> <?php echo form_input($data_folio_ini, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Folio Final: </strong></font></td>
    <td align="left"> <?php echo form_input($data_folio_fin, "");?></td>
</tr>

</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>

<?php

	echo $tabla;
?>

<script language="javascript" type="text/javascript">

        $('#agrega_tarjeta').submit(function() {
            
            
            var sucursal = $('#sucursal').attr("value");
            var folio1 = $('#inicial').attr("value");
            var folio2 = $('#final').attr("value");
            
            
    	 
    	   
            if(data_folio_ini.length == 10 && data_folio_fin.length == 10 ){
                
                if(confirm("Seguro que los datos son correctos ?")){
                    return true;
                }else{
                    return false;
                }
    

    	  }else{


    	    return false    
    	   
    	  }
    	}); 


</script>
</div>