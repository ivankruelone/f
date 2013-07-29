  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'juridico_form_rentas_genera');
    echo form_open('juridico/agrega_renta_mensual', $atributos);
    $data_t_cambio = array(
              'name'        => 'cam',
              'id'          => 'cam',
              'value'       => '',
              'maxlength'   => '8',
              'size'        => '8',
              'type'        => 'number'
            );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa', $aaax, '', 'id="aaa"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mesx, '', 'id="mes"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>TIPO DE CAMBIO: </strong></font></td>
	<td><?php echo form_input($data_t_cambio, "", 'required');?></td>
 </tr>
 

	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#aaa").focus();
    });
    
    $(document).ready(function(){
    
    $('#aaa').blur(function(){
            aaa = $('#aaa').attr("value"); 
     });
     $('#mes').blur(function(){
            mes = $('#mes').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#juridico_form_rentas_genera').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        var cam = $('#cam').attr("value").length;
        
          if(mes > 0 && aaa > 0 && cam>0 ){
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>