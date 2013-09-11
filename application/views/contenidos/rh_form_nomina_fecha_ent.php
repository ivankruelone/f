  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'rh_form_nomina_fecha');
    echo form_open('recursos_humanos/tabla_nomina_entrega_final', $atributos);
 
 $data_fecha_i = array(
              'name'        => 'quincena',
              'id'          => 'quincena',
              'value'       =>'',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );

  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1" color="blue">QUINCENA</font></td>
	<td colspan="1"><?php echo form_input($data_fecha_i);?></td>
 </tr>
 <tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<?php
	echo $tabla
?>
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#quincena").focus();
    });
    
    $(document).ready(function(){
    
       
     
    
   ///////////////////////////////////////////////////
    $(function() {
		$( "#quincena" ).datepicker();
	});
     
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#rh_form_nomina_fecha').submit(function() {
        
        
        var quincena = $('#quincena').attr("value").length;
      
          if(quincena == 10 ){
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>