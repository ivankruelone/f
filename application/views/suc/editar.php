<?php
	$row = $query->row();
?>
<h3>Editar</h3>
<?php
	echo form_open('sucursales/submit');
?>
<table>
<tr>
<td>
	<label for="sucursal"><b>Sucursal</b></label>
	<input type="text" name="sucursal" id="sucursal" value="<?php echo $row->nom_suc?>" disabled="disabled" />
	
	<label for="calle"><b>Calle</b></label>
	<input type="text" name="calle" id="calle" value="<?php echo $row->dom?>"/>
    
    <label for="num_ext"><b>Numero Ext</b></label>
	<input type="text" name="exterior" id="exterior" value="<?php echo $row->num_ext?>"/>
    
    <label for="num_int"><b>Numero Int</b></label>
	<input type="text" name="interior" id="interior" value="<?php echo $row->num_int?>"/>
    
    <label for="colonia"><b>Colonia</b></label>
	<input type="text" name="colonia" id="colonia" value="<?php echo $row->col?>"/>

    <label for="refen"><b>Referencia</b></label>
	<input type="text" name="referencia" id="referencia" value="<?php echo $row->refen?>"/>

    <label for="del_mun"><b>Delegaci&oacute;n o municipio</b></label>
	<input type="text" name="delegacion" id="delegacion" value="<?php echo $row->del_mun?>"/>    

</td>
<td>

    <label for="cuidad"><b>Ciudad</b></label>
	<input type="text" name="ciudad" id="ciudad" value="<?php echo $row->cd?>"/>
    
    <label for="estado"><b>Estado</b></label>
	<input type="text" name="estado" id="estado" value="<?php echo $row->edo?>"/>
    
    <label for="cp"><b>Codigo Postal</b></label>
	<input type="text" name="codigo" id="codigo" value="<?php echo $row->cp?>"/>
    
    <label for="tel"><b>Tel&eacute;fono</b></label>
	<input type="text" name="telefono" id="telefono" value="<?php echo $row->tel?>"/>
    
    <label for="tel1"><b>Tel&eacute;fono</b></label>
	<input type="text" name="telefono1" id="telefono1" value="<?php echo $row->tel1?>"/>
    
    <label for="tel_iu"><b>Iusacell</b></label>
	<input type="text" name="iusacell" id="iusacell" value="<?php echo $row->tel_iu?>"/>
    
    <label for="correo"><b>Correo</b></label>
	<input type="text" name="correo" id="correo" value="<?php echo $row->correo?>"/>

</td>
</tr>
</table>

    <input type="hidden" value="<?php echo $row->suc?>" name="suc" id="suc" />
	<input type="submit" value="Guardar" class="button-link blue" />
    
    
</form>