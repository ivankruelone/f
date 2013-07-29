<p style="font-size: large;">
    <strong><?php echo $titulo;?> </strong>
</p>
<div style="text-align: center;">
<?php
	echo form_open('direccion/recargas', array('id' => 'envio_forma'));
?>
<table style="text-align: center; margin-left: auto; margin-right: auto; font-size: large;">
    <tr>
        <td>Fecha Inicial</td>
        <td><input type="text" size="10" id="fecha_inicial" name="fecha_inicial" /></td>    
    </tr>
    <tr>
        <td>Fecha Final</td>
        <td><input type="text" size="10" id="fecha_final" name="fecha_final" /></td>    
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Genera reporte" /></td>
    </tr>
</table>
<?php
	echo form_close();
?>
</div>
<script>

$(document).ready(function(){
    
$('#fecha_inicial').datepicker();
$('#fecha_final').datepicker();

$('#envio_forma').submit(function(event){
    
    var $fecha_inicial = $('#fecha_inicial').attr('value');
    var $fecha_final = $('#fecha_final').attr('value');
    
    if($fecha_inicial.length == 10 && $fecha_final.length == 10){
        
    }else{
        alert('Elige las fechas');
        event.preventDefault();
    }
    
});


});


</script>

