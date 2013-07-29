  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'pedido_form_0');
    echo form_open('pedido/imprime_pedidos_ctl ', $atributos);
      $data_fol1 = array(
              'name'        => 'fol1',
              'id'          => 'fol1',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
              
              
            );
     $data_fol2 = array(
              'name'        => 'fol2',
              'id'          => 'fol2',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
              
              
            );

  ?>
 
  <table>


<tr>
	<td align="left" ><font size="+1"><strong>FOLIO INICIAL: </strong></font></td>
	<td><?php echo form_input($data_fol1, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>FOLIO FINAL: </strong></font></td>
	<td><?php echo form_input($data_fol2, "", 'required');?></td>
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
        $("#fol1").focus();
    });
    
    $(document).ready(function(){
    
    $('#fol1').blur(function(){
            fol1 = $('#fol1').attr("value"); 
     });
     $('#fol2').blur(function(){
            fol2 = $('#fol2').attr("value"); 
     });
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#pedido_form_1').submit(function() {
        
        
        var fol1 = $('#fol1').attr("value").length;
        var fol2 = $('#fol2').attr("value").length;
        
          if(fechax > 0 ){
    	  }else{
            alert('VERIFICA LA FECHA SI ES LA CORRECTA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>