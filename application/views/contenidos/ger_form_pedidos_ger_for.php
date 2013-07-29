  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'ger_form_pedidos_ger_for');
    echo form_open('gerente/tabla_desplaza_t', $atributos);
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1">CLASIFICACION: </font></td>
    <td align="left"> 
    <select name="var" id="var">
    <option value="0" <?php if($var=="''") echo "Selected"?> >Seleccione una clasificacion</option>
    <option value="1" <?php if($var=="'a','b'") echo "Selected"?> >A y B</option>
    <option value="2" <?php if($var=="'a','b','c'") echo "Selected"?> >A,B y C </option>
    <option value="3" <?php if($var=="'a','b','c'.'d'") echo "Selected"?> >A,B,C y D </option>
    
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
    $('#ger_form_pedidos_ger_for').submit(function() {
        
        
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