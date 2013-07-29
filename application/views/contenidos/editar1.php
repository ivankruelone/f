<div align="center">

<blockquote>Editar</blockquote>
<?php
	echo form_open('equipos/submit');
?>
<table>
<tr>
	<td align="left" ><font size="+1"><strong>Empleado: </strong></font></td>
	<td align="left"><?php echo form_dropdown('empleado', $empleado, '', 'id="empleado"') ;?> </td>
</tr> 
</table>

    <input type="hidden" value="<?php echo $id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
<?php
	echo form_close();
?>

</div>