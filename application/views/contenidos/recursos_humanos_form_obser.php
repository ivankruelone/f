<h2 align="center">ALTA DE EMPLEADOS A SUCURSALES</h2>
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'recursos_humanos_form_obser');
    echo form_open('recursos_humanos/movimiento_reporta_valida_recursos', $atributos);
 
  $data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'value'       => '',
              'maxlength'   => '255',
              'size'        => '50',
              
              
              
            );
            
  ?>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>
<table>

<tbody>
<tr>
<th colspan="2"><?php echo  $titulo?></th>
</tr>

<tr>
	<td align="left" ><font size="+1">Observacion: </font></td>
	<td><?php echo form_input($data_obser, "", 'required');?></td>
</tr>
  
 <tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<input type="hidden" value="<?php echo $id?>" name="id"  id="id" />
<input type="hidden" value="<?php echo $motivo?>" name="motivo"  id="motivo" />
  <?php
	echo form_close();
  ?>

</div>
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#obser").focus();
    });
    
    
     });
     $(function() {
		$( "#obser" ).datepicker();
	});
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#recursos_humanos_form_obser').submit(function() {
        var  obser = $('#obser').attr("value").length;
      
        
          if(obser > 0 ){
    	  }else{
            alert('SELECCIONE EL MES ');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>