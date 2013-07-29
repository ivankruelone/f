<?php
	$row = $query->row();
?>
<h3>Editar</h3>
<?php
	echo form_open('prenomina/submit');
?>
<table>
<tr>
<td>
	<label for="id"><b>id</b></label>
	<input type="text" name="id" id="id" value="<?php echo $row->id?>" disabled="disabled" />
	
	<label for="apellido_pat"><b>Apellido Paterno:</b></label>
	<input type="text" name="paterno" id="paterno" value="<?php echo $row->apellido_pat?>"/>
    
    <label for="apellido_mat"><b>Apellido Materno:</b></label>
	<input type="text" name="materno" id="materno" value="<?php echo $row->apellido_mat?>"/>
    
    <label for="nombre"><b>Nombre</b></label>
	<input type="text" name="nombre" id="nombre" value="<?php echo $row->nombre?>"/>
    
    <label for="clave_empleado"><b>Clave del empleado</b></label>
	<input type="text" name="clave" id="clave" value="<?php echo $row->clave_empleado?>"/>

    

        

</td>
<td>
    <label for="no_ss"><b>NSS</b></label>
	<input type="text" name="nss" id="nss" value="<?php echo $row->no_ss?>"/>

    <label for="rfc"><b>RFC</b></label>
	<input type="text" name="rfc" id="rfc" value="<?php echo $row->rfc?>"/>

    <label for="cia"><b>Compa&ntilde;ia</b></label>
	<?php echo $row->cia?>
    <br />
    <label for="salario"><b>Salario</b></label>
	<input type="text" name="salario" id="salario" value="<?php echo $row->salario?>"/>
    
    <label for="fecha_ingreso"><b>Fecha de Ingreso</b></label>
	<input type="text" name="fecha" id="fecha" value="<?php echo $row->fecha_ingreso?>"/>
    
    <label for="plaza"><b>Plaza</b></label>
	<?php echo $row->plaza?>

</td>
</tr>
</table>

    <input type="hidden" value="<?php echo $row->id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
    
</form>