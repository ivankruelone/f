<blockquote>
    
    <p align="center"><strong>SUCURSALES QUE TRANSMITIERON</strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'pedidos_12');
    echo form_open('pedido/tabla_contol_12_00', $atributos);
    
    $data_hora = array(
              'name'        => 'hora',
              'id'          => 'hora',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
            
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
   
?>

<table>
<th colspan="2">SELECCIONAR FECHA DE PEDIDOS</th>
<tr>
    <td colspan="2">HORA: <?php echo form_input($data_hora, "", 'required').'HH'; ?></td>
</tr>
<tr>
    <td colspan="2">FECHA: <?php echo form_input($data_fec1, "", 'required').'AAAA-MM-DD';?></td>
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
        $("#hora").focus();
    });
    
    $(document).ready(function(){
    
    
    $('#fec1').datepicker();
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#pedidos_12').submit(function() {
        var fec1 = $('#fec1').attr("value").length;
        var hora = $('#hora').attr("value").length;
        
          if(hora == 2 && fec1 == 10){
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