<div align="center">

<blockquote>Editar</blockquote>
<?php
	echo form_open('procesos/submit_p');
    $row=$query->row();
?>
<table>
<tr>
	<td>
        <label for="dia"><b>Dia:</b></label>
    </td>
    <td>	
        <input type="text" name="dia" id="dia" value="<?php echo $row->dia?>"/>
    </td>
</tr> 
</table>

    <input type="hidden" value="<?php echo $suc?>" name="suc" id="suc" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
<?php
	echo form_close();
?>

</div>