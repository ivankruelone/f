  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_folio_fal');
    echo form_open('a_surtido/actualiza_fal', $atributos);
    
    $data_faltante = array(
              'name'        => 'faltante',
              'id'          => 'faltante',
              'size'        => '15',
              'type'        => 'text',
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
    <td align="left" ><font size="+1"><strong>Faltante </strong></font></td>
    <td align="left"> <?php echo form_input($data_faltante, ""); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('id', $id);
	echo form_close();
  ?>
  
  <div>
  
  
  
  </div>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#faltante").focus();
    });
    
    $(document).ready(function(){
    
    $('#faltante').blur(function(){
            faltante = $('#faltante').attr("value"); 
     });
    
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_folio_fal').submit(function() {
        
        
        var faltante = $('#faltante').attr("value");
        
          if(faltante > 0 ){
    	  }else{
            alert('INGRESE FALTANTE');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>