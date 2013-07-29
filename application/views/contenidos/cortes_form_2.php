  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cortes_form_2');
    echo form_open('cortes/tabla_control_poliza_filtro ', $atributos);
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
	<td align="left" ><font size="+1">QUINCENA: </font></td>
    <td align="left"> 
    <select name="quin" id="quin">
    <option value="1" <?php if($quin=='1') echo "Selected"?> >PRIMERA</option>
    <option value="2" <?php if($quin=='2') echo "Selected"?> >SEGUNDA</option>
    <option value="3" <?php if($quin=='3') echo "Selected"?> >MES COMPLETO</option>
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
    $('#cortes_form_2').submit(function() {
        
        
        var aaa = $('#aaa').attr("value");
        var mes = $('#mes').attr("value").length;
        
          if(mes > 0 && aaa > 0 ){
          if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }  
    	  }else{
            alert('SELECCIONE EL MES DE LA POLIZA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>