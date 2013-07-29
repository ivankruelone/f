   <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_inv_form_modi_cadu');
    echo form_open('a_inv/modifica_cadu', $atributos);
         $data_cadu = array(
              'name'        => 'cadu',
              'id'          => 'cadu',
              'size'        => '15',
              'value'      => $cadu,
              'type'        => 'varchar',
              'required'   => 'required'
            );
 

  ?>
 
  <table>
<tr>
  <th colspan="6"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left"colspan="2"><font size="+1"><?php echo $sec." - ".$susa;?></font></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">LOTE.:</font></td>
	<td colspan="1"><?php echo $lote;?></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">CADUCIDAD: <?php echo $cadu;?></font></td>
	<td colspan="1"><?php echo form_input($data_cadu)?></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">CANTIDAD: </font></td>
	<td colspan="1"><?php echo $inv1;?></td>
 </tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $sec?>" name="sec" id="sec" />
<input type="hidden" value="<?php echo $lote?>" name="lote" id="lote" />
<input type="hidden" value="<?php echo $inv1?>" name="inv1" id="inv1" />
<input type="hidden" value="<?php echo $cadu?>" name="cadua" id="cadua" />

  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#lote").focus();
    });
    
    $(document).ready(function(){
    
    $('#lote').blur(function(){
            lote = $('#lote').attr("value"); 
     });
     $('#cadu').blur(function(){
            cadu = $('#cadu').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_inv_form_modi_cadu').submit(function() {
        
        
        var lote = $('#lote').attr("value").length;
        var cadu = $('#cadu').attr("value").length;
        
          if(lote > 0 && cadu > 0 ){
    	  }else{
            alert('VERIFIQUE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>