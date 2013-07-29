  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'proceso_form_orden_cedis');
    echo form_open('procesos/sutmit_orden_cedis', $atributos);
    $data_pass = array(
              'name'        => 'pass',
              'id'          => 'pass',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              'type'        =>'password'
              
            );
    $data_dia = array(
              'name'        => 'dia1',
              'id'          => 'dia1',
              'value'       => date('d'),
              'maxlength'   => '2',
              'size'        => '2'
              
              
            );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left" ><font size="+1">PASSWORD: </font></td>
    <td><?php echo form_input($data_pass, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa1', $aaax, '', 'id="aaa1"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes1', $mesx, '', 'id="mes1"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Dia: </font></td>
    <td><?php echo form_input($data_dia, "", 'required');?></td>
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
    $('#proceso_form_orden_cedis').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        
          if(mes > 0 && aaa > 0 ){
    	  }else{
            alert('SELECCIONE EL MES');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>