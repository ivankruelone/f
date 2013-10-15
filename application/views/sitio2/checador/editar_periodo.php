<div align="center">

<blockquote>Editar</blockquote>
<?php
	echo form_open('checador/submit_p');
    $row=$query->row();
?>
<table>
<tr>
	<td>
        <label for="dias"><b>Dias</b></label>
    </td>
    <td>	
        <input type="text" name="dias" id="dias" value="<?php echo $row->dias?>"/>
    </td>
</tr> 
</table>
    <input type="hidden" value="<?php echo $row->nomina?>" name="nomina" id="nomina" />
    <input type="hidden" value="<?php echo $id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
<?php
	echo form_close();
?>

</div>