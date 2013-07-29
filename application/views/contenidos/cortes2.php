
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<h1><strong>A todos los contadores verifiquen su plantilla de personal en el sistema; si les falta alguien, notificarlo en sistemas.</strong></h1>
<div align="center">
<?php
	$atributos = array('id' => 'cortes1');
    echo form_open('cortes/tabla_control_cre2', $atributos);

$data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
$data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );

  ?>
  
  <table>
<th colspan="2">SELECCIONAR FECHA DE FALTANTES DE CAJA</th>
<tr>
    <td colspan="2">FECHA INICIAL: <?php echo form_input($data_fec1, "", 'required').'AAAA-MM-DD'; ?></td>
</tr>
<tr>
    <td colspan="2">FECHA FINAL..: <?php echo form_input($data_fec2, "", 'required').'AAAA-MM-DD';?></td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>PLAZA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('plaza1', $plaza1, '', 'id="plaza1"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>


<?php
   echo '<font size="+1" color="red">'.$titulo1.'</font>';
	echo $tabla;
?>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fec1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fec1').datepicker();
    $('#fec2').datepicker();
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#cortes1').submit(function() {
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