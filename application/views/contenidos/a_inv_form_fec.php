  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_inv_form_fec');
    echo form_open('a_inv/tabla_control_his_det ', $atributos);
         $data_d1 = array(
              'name'        => 'd1',
              'id'          => 'd1',
              'size'        => '2',
              'type'        => 'number',
              'required'   => 'required'
            );
             $data_d2 = array(
              'name'        => 'd2',
              'id'          => 'd2',
              'size'        => '2',
              'type'        => 'number',
              'required'   => 'required'
            );

  ?>
 
  <table>
<tr>
  <th colspan="6"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa1', $aaax1, '', 'id="aaa1"') ;?> </td>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes1', $mesx1, '', 'id="mes1"') ;?> </td>
    <td align="left" ><font size="+1">DIA: </font></td>
	<td colspan="1"><?php echo form_input($data_d1);?></td>

 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa2', $aaax2, '', 'id="aaa2"') ;?> </td>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes2', $mesx2, '', 'id="mes2"') ;?> </td>
    <td align="left" ><font size="+1">DIA: </font></td>
	<td colspan="1"><?php echo form_input($data_d2);?></td>

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
    $('#a_inv_form_fec').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        
          if(mes > 0 && aaa > 0 ){
    	  }else{
            alert('SELECCIONE LAS FECHAS DE MOVIMIENTOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>