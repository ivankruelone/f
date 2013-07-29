  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'mercadotecnia_form_nota_s');
    echo form_open('mercadotecnia/tabla_nota_suc_d ', $atributos);
  ?>
 
  <table>

<tr>
<th colspan="2">SELECCION DE FECHA</th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa', $aaax, '', 'id="aaa"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mesx, '', 'id="mes"') ;?> </td>
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
    $('#mercadotecnia_form_nota_s').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        
          if(mes > 0 && aaa > 0 ){
    	  }else{
            alert('SELECCIONE EL A&Ntilde;O Y MES');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>