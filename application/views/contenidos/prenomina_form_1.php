<h2 align="center">CAPTURA Y GENERACI&Oacute;N DE LA PRE NOMINA</h2>
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	$atributos = array('id' => 'prenomina_form_1');
    echo form_open('prenomina/tabla_captura_1 ', $atributos);
  ?>
<table>
<tbody>
<tr>
<th colspan="2"><?php echo  $titulo ?></th>
</tr>
<tr bgcolor="red">
<td colspan="2"><?php echo  'EL SISTEMA NO PERMITE CAPTURAR PRIMA DOMINICAL NI DIAS FESTIVOS A PERSONAL QUE NO TENGA EL PUESTO DE ENCARGADOS, JEFES DE MOSTRADOR o MULTIFUNCIONA' ?></td>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>CONCEPTO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('cla', $clax, '', 'id="cla"') ;?> </td>
 </tr>
 </tr>
	<td colspan="4" align="center"  class="button-link blue"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>

</tbody>
</table>
<tr>
<th colspan="2"><?php echo  $tabla ?></th>
</tr>

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
    $('#envio_form_1').submit(function() {
        
        
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