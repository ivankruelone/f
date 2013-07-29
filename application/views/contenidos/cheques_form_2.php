  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
    <p><strong><?php echo $mensaje;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_2');
    echo form_open('cheques/cancelar_c', $atributos);
     $data_contra = array(
              'name'        => 'contra',
              'id'          => 'contra',
              'value'       => '',
              'maxlength'   => '16',
              'size'        => '16',
              'type'        =>'password'
              
              
            );
   
  ?>
<table align="center">
<tr>
	<td><?php echo $tabla;?></td>
</tr>
</table>  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1">CONTRASE&Ntilde;A: </font></td>
	<td><?php echo form_input($data_contra, "", 'required');?></td>
</tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#contra").focus();
    });
    
    $(document).ready(function(){
    
    $('#contra').blur(function(){
            contra = $('#contra').attr("value"); 
     });
     
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cheques_form_2').submit(function() {
        
        
        var contra = $('#contra').attr("value").length;
          if(contra > 0 ){
    	  }else{
            alert('DIGITE LA CLAVE PARA CANCELAR');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>