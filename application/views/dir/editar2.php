<?php
	$row = $query->row();
?>
<h3>Editar</h3>
<?php
	echo form_open('directorio/submit1');
?>
<table>
<tr>
<td>
	<label for="nom"><b>Nombre</b></label>
	<input type="text" name="nom" id="nom" value="<?php echo $row->nombre?>" />
	
	<label for="zonx"><b>Zona</b></label>
	<input type="text" name="zonx" id="zonx" value="<?php echo $row->zona?>"/>
    
    <label for="tel"><b>Movil o Telefono</b></label>
	<input type="text" name="tel" id="tel" value="<?php echo $row->telefono?>"/>
    
    <label for="email"><b>Correo</b></label>
	<input type="text" name="email" id="email" value="<?php echo $row->mail?>"/>       
</td>
</tr>
</table>

    <input type="hidden" value="<?php echo $row->id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
    
</form>