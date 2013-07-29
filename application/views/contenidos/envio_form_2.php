  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'envio_form_2');
    echo form_open('envio/tabla_faltante_nom ', $atributos);
  ?>
 
  <table>

<tr>
<th colspan="2"><?php echo $titulo?></th>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><font size="+2"><?php echo $aaa ;?></font></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><font size="+2"><?php echo  $mesx ;?></font> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1">QUINCENA: </font></td>
    <td align="left"><font size="+2"><?php echo  $quin ;?></font> </td>
</tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $fec ?>" name="fec" id="fec" />
<input type="hidden" value="<?php echo $aaa ?>" name="aaa" id="aaa" />
<input type="hidden" value="<?php echo $mes ?>" name="mes" id="mes" />
<input type="hidden" value="<?php echo $quin ?>" name="quin" id="quin" />
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
    $('#envio_form_2').submit(function() {
        
        aa = 2012;
        
          if(aa > 0 ){
            
    	  }else{
            alert('SELECCIONE EL MES');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>