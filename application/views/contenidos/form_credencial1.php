
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<div align="center">

<?php
	$atributos = array('id' => 'credencial');
    echo form_open('credencial/formato_credencial1', $atributos);

  ?>
  
  <table>
<th colspan="2"><font size="+1">Selecciona el empleado</font></th>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $empleadox, '', 'id="nombre"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Generar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>

  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nombre").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#credencial').submit(function(event){
        
        var nombre = $('#nombre').attr('value');
        //alert(nombre);
        
        if(nombre == 0){
            alert('Debes seleccionar un empleado.');
            event.preventDefault();
        
           } else{
            //evita que se ejecute el evento
           }
           ////////////////fin     
        
    });          
                
     
});
  </script>
