  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'supervisor_form_repo');
    echo form_open('supervisor/movimiento_mot', $atributos);
 $data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'size'        => '50',
              'type'        => 'varchar',
              'required'   => 'required'
            );
 $data_fecha_i = array(
              'name'        => 'fecha_i',
              'id'          => 'fecha_i',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
 $data_folio_inca = array(
              'name'        => 'folio_inca',
              'id'          => 'folio_inca',
              'maxlength'   => '20',
              'size'        => '20'
              );
 $data_dias = array(
              'name'        => 'dias',
              'id'          => 'dias',
              'maxlength'   => '2',
              'size'        => '2'
              );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>MOTIVO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mot', $motx, '', 'id="mot"') ;?> </td>
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
     
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#supervisor_form_repo').submit(function() {
        
        
        var mot = $('#mot').attr("value");
      
          if(mot > 0 ){
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>