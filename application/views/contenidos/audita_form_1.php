  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'audita_form_1');
    echo form_open('audita/tabla_control_decena ', $atributos);
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
	<td align="left" ><font size="+1">DECENA: </font></td>
    <td align="left"> 
    <select name="decena" id="decena">
    <option value="1" <?php if($decena=='1') echo "Selected"?> >PRIMERA</option>
    <option value="2" <?php if($decena=='2') echo "Selected"?> >SEGUNDA</option>
    <option value="3" <?php if($decena=='3') echo "Selected"?> >TERCERA</option>
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
    $('#audita_form_1').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        
          if(mes > 0 && aaa > 0 ){
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>