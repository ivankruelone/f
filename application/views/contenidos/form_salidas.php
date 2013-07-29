

<div align="center">
<p><strong><font size="+2"><?php echo $titulo;?></font></strong></p>
<?php
	$atributos = array('id' => 'salida');
    echo form_open('vacaciones/salidas_submit', $atributos);

  ?>
  
  <table>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 1: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $empleadox, '', 'id="nombre"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 2: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre1', $empleadox1, '', 'id="nombre1"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 3: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre2', $empleadox2, '', 'id="nombre2"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 4: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre3', $empleadox3, '', 'id="nombre3"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 5: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre4', $empleadox4, '', 'id="nombre4"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Asunto: </strong></font></td>
    <td align="left"><?php echo form_dropdown('asunto', $asuntox, '', 'id="asunto"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>Regresara: </strong></font></td>
    <td align="left"><?php echo form_dropdown('regreso', $regresox, '', 'id="regreso"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
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

    $('#salida').submit(function(event){
        
        var nombre = $('#nombre').attr('value');
        var asunto = $('#asunto').attr('value');
        var regreso = $('#regreso').attr('value');
        
        if(nombre == 0){
            alert('Debes seleccionar un empleado.');
            event.preventDefault();
        }else{
            
        if(asunto == 0) {
            alert('Debes seleccionar el asunto.');
            event.preventDefault();
        }else{ 
          
        if(regreso == 0) {
            alert('Debes seleccionar si regresara.');
            event.preventDefault();
        }else{  
        
       
            /////////////inicio
           if(confirm("Seguro que la inf. es correcta?")){
            return true;
            
           } else{
            //evita que se ejecute el evento
            event.preventDefault();
            return false;
           }
           ////////////////fin

          }  
        }
        }
        
    });          
          
        
     
});
  </script>
