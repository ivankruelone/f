  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'compra_form_orden_cedis');
    echo form_open('compras/sutmit_orden_cedis', $atributos);
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
  $data_aaa2 = array(
              'name'        => 'aaa2',
              'id'          => 'aaa2',
              'value'       => (date('d')-1),
              'maxlength'   => '2',
              'size'        => '2'
              
              
            );
   echo $tabla;
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
	<td align="left" colspan="2"><font size="+1"><strong>PAR&Aacute;METROS PARA TOMAR ENCUENTA EL TRANSITO DE LA COMPRA</strong></font></td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa1', $aaax1, '', 'id="aaa1"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes1', $mesx1, '', 'id="mes1"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Dia: </font></td>
    <td><?php echo form_input($data_dia, "", 'required');?></td>
 </tr>
 <tr>
	<td align="left" colspan="2"><font size="+1"><strong>PAR&Aacute;METROS PARA TOMAR ENCUENTA EL DESPLAZAMIENTO DEL A&Ntilde;O ANTERIOR</strong></font></td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td><font size="+2"><?php echo  $aaa2?></font></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes2', $mesx2, '', 'id="mes2"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA A: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA B: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA C: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA D: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
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
    $('#compra_form_orden_cedis').submit(function() {
        
        
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