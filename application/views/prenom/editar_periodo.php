<?php
	$row = $query->row();
?>
<h3>Editar</h3>
<?php
	echo form_open('prenomina/guardar_periodo');
?>
<table>
<tr>
<td>
	<label for="id"><b>id</b></label>
	<input type="text" name="id" id="id" value="<?php echo $row->id?>" disabled="disabled" />
	
	<label for="cia"><b>Compa&ntilde;ia</b></label>
	<?php echo $row->cia?>
    <br />
    
    <label for="plaza"><b>Plaza</b></label>
	<?php echo $row->plaza?>
    <br />
    
    <label for="quincena"><b>Quincena:</b></label>
	<input type="text" name="quincena" id="quincena" value="<?php echo $row->quincena?>"/>
    
    <label for="mes"><b>Mes:</b></label>
	<input type="text" name="mes" id="mes" value="<?php echo $row->mes?>"/>
    
    <label for="ano"><b>A&ntilde;o</b></label>
	<input type="text" name="ano" id="ano" value="<?php echo $row->ano?>"/>

</td>
</tr>
</table>

    <input type="hidden" value="<?php echo $row->id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
    
</form>