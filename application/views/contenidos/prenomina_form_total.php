  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'prenomina_form_3');
    echo form_open('prenomina/tabla_poliza_bloque1 ', $atributos);
  ?>
 
  <table>
<tr>
<th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>PLAZA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('plaza1', $plaza1, '', 'id="plaza1"') ;?> </td>
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
	<td align="left" ><font size="+1">QUINCENA: </font></td>
    <td align="left"> 
    <select name="quin" id="quin">
    <option value="1" <?php if($quin=='1') echo "Selected"?> >PRIMERA</option>
    <option value="2" <?php if($quin=='2') echo "Selected"?> >SEGUNDA</option>
    
    </select>
    </td>
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
        $("#plaza1").focus();
    });
    
    $(document).ready(function(){
    
    $('#plaza1').blur(function(){
            plaza1 = $('#plaza1').attr("value"); 
     });
    $('#aaa').blur(function(){
            aaa = $('#aaa').attr("value"); 
     });
     $('#mes').blur(function(){
            mes = $('#mes').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#prenomina_form_3').submit(function() {
        
        var plaza1 = $('#plaza1').attr("value");
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value");
        
        if(plaza1 == 0){
            alert('Elige una plaza antes de continuar.');
            return false;
        }else{
            
            if(aaa == 0){
                alert('Elige el ano antes de continuar.');
                return false;
            }else{
                if(mes == 0){
                    alert('Elige el mes antes de continuar.');
                    return false;
                }else{
                    return true;
                }
            }
        }
        
        
        
   
   });
          
          
        
     
});
  </script>