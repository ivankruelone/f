  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'sistemas_form_reporte_deptos');
    echo form_open('sistemas/reportes_deptos_imp', $atributos);
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
   
   
   
   $(function() {
		$( "#fec1" ).datepicker();
	});
     $(function() {
		$( "#fec2" ).datepicker();
	});  
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#sistemas_form_reporte_deptos').submit(function() {
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