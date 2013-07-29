  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'pedido_form_0');
    echo form_open('pedido/tabla_envio_fin ', $atributos);
      $data_fechax = array(
              'name'        => 'fechax',
              'id'          => 'fechax',
              'value'       => $fechax,
              'maxlength'   => '13',
              'size'        => '13'
              
              
            );

  ?>
 
  <table>


<tr>
	<td align="left" ><font size="+1"><strong>FECHA: </strong></font></td>
	<td><?php echo form_input($data_fechax, "", 'required');?></td>
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
    $('#pedido_form_0').submit(function() {
        
        
        var fechazx = $('#fechax').attr("value").length;
        
          if(fechax > 0 ){
    	  }else{
            alert('VERIFICA LA FECHA SI ES LA CORRECTA');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>