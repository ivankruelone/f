  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'encargado_form_ventas_spt');
    echo form_open('encargado/agrega_spt', $atributos);
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left" ><font size="+1"><strong>Medico: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $nombre, '', 'id="nombre"') ;?> </td>
 </tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
  
  <div>
  
  <?php echo $tabla; ?>
  
  </div>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nombre").focus();
    });
    
    $(document).ready(function(){
    
    $('#nombre').blur(function(){
            nombre = $('#nombre').attr("value"); 
     });
    
     
    
   ///////////////////////////////////////////////////

/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#encargado_form_ventas_spt').submit(function() {
        
        
        var nombre = $('#nombre').attr("value");
        
          if(nombre > 0 ){
    	  }else{
            alert('SELECCIONE UN MEDICO');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>