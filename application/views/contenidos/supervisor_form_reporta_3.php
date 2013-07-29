  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'supervisor_form_reporta_3');
    echo form_open('supervisor/movimiento_his_alta_historico_fecha', $atributos);
 $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
 $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => date('Y-m-d'),
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
	<td align="left" ><font size="+1">FECHA: </font></td>
	<td colspan="1"><?php echo form_input($data_fec1);?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1">FECHA: </font></td>
	<td colspan="1"><?php echo form_input($data_fec2);?></td>
 </tr>
 
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
        $("#fec1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fec1').blur(function(){
            fec1 = $('#fec1').attr("value"); 
     });
     $('#fec2').blur(function(){
            fec2 = $('#fec2').attr("value"); 
     });
     
     
     $(function() {
		$( "#fec1" ).datepicker();
	});
     $(function() {
		$( "#fec2" ).datepicker();
	});
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#supervisor_form_reporta_3').submit(function() {
        
        
        var fec1 = $('#fec1').attr("value");
        var fec2 = $('#fec2').attr("value");
       
          
   
   });
          
          
        
     
});
  </script>