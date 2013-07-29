  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'encargado_form_repo');
    echo form_open('encargado/movimiento_mot', $atributos);
 

 $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'value'       => '',
              'maxlength'   => '12',
              'size'        => '12',
              'type'        =>'password'
              );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
  <td colspan="2"><font size="+2"><?php echo $titulo1;?></font></td>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>MOTIVO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mot', $motx, '', 'id="mot"') ;?> </td>
 </tr>

 <tr>
	<td align="left" ><font size="+1" color="blue">PASSWORD: </font></td>
	<td colspan="1"><?php echo form_input($data_clave).date('H');?></td>
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
        $("#mot").focus();
    });
    
    $(document).ready(function(){
    
    $('#mot').blur(function(){
            mot = $('#mot').attr("value"); 
     });
     
     
     $(function() {
		$( "#fecha_i" ).datepicker();
	});
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#encargado_form_repo').submit(function() {
        
        var clave = $('#clave').attr("value").length;
        var mot = $('#mot').attr("value").length;
     
          if(mot > 0 && clave == 12){
    	  }else{
            alert('SELECCIONE EL MOTIVO O DIGITE EL PASSWORD CORRECTO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>