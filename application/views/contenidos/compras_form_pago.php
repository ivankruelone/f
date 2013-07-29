  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'compras_form_pago');
    echo form_open('compras/tabla_pagos_imp', $atributos);
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
<th colspan="2">SELECCIONAR FECHA DE MOVIMIENTOS</th>
<tr>
    <td colspan="2">FECHA: <?php echo form_input($data_fec1, "", 'required').'AAAA-MM-DD'; ?></td>
</tr>


<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Generar');?></td>
</tr>
</table>
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
   
   
   
   $(function() {
		$( "#fec1" ).datepicker();
	});
      
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#compras_form_pago').submit(function() {
        var fec1 = $('#fec1').attr("value").length;
          if(fec1 == 10){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#fec1').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>