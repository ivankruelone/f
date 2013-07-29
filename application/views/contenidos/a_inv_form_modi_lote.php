   <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_inv_form_modi_lote');
    echo form_open('a_inv/modifica_lote', $atributos);
         $data_lote = array(
              'name'        => 'lote',
              'id'          => 'lote',
              'size'        => '15',
              'value'      => $lote1,
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
    <td align="left" ><font size="+1">LOTE.: <?php echo $lote1;?> </font></td>
	<td colspan="1"><?php echo form_input($data_lote);?></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">CADUCIDAD: </font></td>
	<td colspan="1"><?php echo $cadu?></td>
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
<input type="hidden" value="<?php echo $lote1?>" name="lote1" id="lote1" />
<input type="hidden" value="<?php echo $inv1?>" name="inv1" id="inv1" />
<input type="hidden" value="<?php echo $cadu?>" name="cadu" id="cadu" />

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
    $('#a_inv_form_modi_lote').submit(function() {
        
        
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