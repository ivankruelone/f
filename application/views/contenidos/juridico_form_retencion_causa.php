<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'juridico_form_retencion_causa');
    echo form_open('juridico/actualiza_causaj', $atributos);
 
  $data_causa = array(
              'name'        => 'causa',
              'id'          => 'causa',
              'value'       => $causaj,
              'maxlength'   => '255',
              'size'        => '50',
              
              
              
            );
            
  ?>
 <table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>


<tbody>


<tr>
	<td align="left" ><font size="+1">ESTATUS DE RETENCION : </font></td>
	<td><?php echo form_input($data_causa, "", 'required');?></td>
</tr>
  
 <tr>
	<td colspan="2" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<input type="hidden" value="<?php echo $id?>" name="id"  id="id" />
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