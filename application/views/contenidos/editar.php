<div align="center">

<?php
	$row = $query->row();
?>
<blockquote>Editar</blockquote>
<?php
	echo form_open('directorio/submit');
?>
<table>
<tr>
    <td>
        <label for="extencion"><b>Extensi&oacute;n</b></label>
    </td>
    <td>	
        <input type="text" name="extension" id="extension" value="<?php echo $row->extension?>"/>
    </td>
</tr>

<tr>
    <td>
        <label for="extencion"><b>Tel. Fijo</b></label>
    </td>
    <td>
    	<input type="text" name="fijo" id="fijo" value="<?php echo $row->fijo?>"/>
    </td>
</tr>
<tr>
<td>  
    <label for="telefono"><b>Movil</b></label>
    </td>
<td>
	<input type="text" name="celular" id="celular" value="<?php echo $row->cel?>"/>
</td>
</tr>
<tr>
<td>    
    <label for="email"><b>Correo</b></label>
    </td>
<td>
	<input type="text" name="email" id="email" value="<?php echo $row->correo?>"/>       
</td>
</tr>
</table>

    <input type="hidden" value="<?php echo $id?>" name="id" id="id" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
<?php
	echo form_close();
?>
</div>