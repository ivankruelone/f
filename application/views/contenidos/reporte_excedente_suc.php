
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<div align="center">

<?php
	$atributos = array('id' => '#motivo');
    echo form_open('a_gerente/reporte_excedente_submit');


  $fecha1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
$fecha2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );

  ?>
  
  <table>
<th colspan="2">SELECCIONAR FECHA Y MOTIVO AGRUPADO POR SUCURSAL</th>
<tr>
    <td colspan="2">FECHA INICIAL: <?php echo form_input($fecha1, "", 'required').'AAAA-MM-DD'; ?></td>
</tr>
<tr>
    <td colspan="2">FECHA FINAL..: <?php echo form_input($fecha2, "", 'required').'AAAA-MM-DD';?></td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>MOTIVO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('motivo', $motivox, '', 'id="motivo"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>

  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fec1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fec1').datepicker();
    $('#fec2').datepicker();
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#motivo').submit(function() {
        var fec1 = $('#fec1').attr("value").length;
        var fec2 = $('#fec2').attr("value").length;
        
          if(fec1 == 10 && fec2 == 10){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>
