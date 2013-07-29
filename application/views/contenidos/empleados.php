

<div align="center">
<?php
    
	echo form_open('catalogo/buscar_empleado3');
?>

<table>
<th colspan="2" align="center">Selecciona un Empleado</th>
<tr>
	<td align="left" ><font size="+1"><strong>Empleado: </strong></font></td>
	<td align="left"><?php echo form_dropdown('empleado', $empleado, '', 'id="empleado"') ;?> </td>
</tr>

</table>

	<input type="submit" value="Buscar" class="button-link blue" />

    

<?php
	echo form_close();
?>

<?php
	echo $tabla;
?>

</div>