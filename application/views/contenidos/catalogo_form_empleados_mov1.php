  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_mov');
    echo form_open('catalogo/tabla_empleados_mov_imp1', $atributos);
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
<th colspan="2">SELECCIONAR FECHA DE MOVIMIENTOS</th>
<tr>
    <td colspan="2">FECHA INICIAL: <?php echo form_input($data_fec1, "", 'required').'AAAA-MM-DD'; ?></td>
</tr>
<tr>
    <td colspan="2">FECHA FINAL..: <?php echo form_input($data_fec2, "", 'required').'AAAA-MM-DD';?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Motivo: </font></td>
	<td align="left"><?php echo form_dropdown('mot', $motx, '', 'id="mot"') ;?> </td>
	
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>PLAZA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('conta', $conta, '', 'id="conta"') ;?> </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>

<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

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

    $('#catalogo_form_empleados_mov').submit(function() {
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
  
