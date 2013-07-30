  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_folio_sob');
    echo form_open('a_surtido/actualiza_sob', $atributos);
    
    $data_sobrante = array(
              'name'        => 'sobrante',
              'id'          => 'sobrante',
              'size'        => '15',
              'type'        => 'text',
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
    <td align="left" ><font size="+1"><strong>Sobrante </strong></font></td>
    <td align="left"> <?php echo form_input($data_sobrante, ""); ?></td>
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
        $("#sobrante").focus();
    });
    
    $(document).ready(function(){
    
    $('#sobrante').blur(function(){
            sobrante = $('#sobrante').attr("value"); 
     });
    
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_folio_sob').submit(function() {
        
        
        var sobrante = $('#sobrante').attr("value");
        
          if(sobrante > 0 ){
    	  }else{
            alert('INGRESE SOBRANTE');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>