<div style="font-size: x-large; width: 100%;">
<strong><?php echo $titulo;?></strong>
</div>
<div style="width: 100%; padding-top: 50px; padding-left: 20px;">
<?php echo form_open('catalogo_externo/do_upload_saba', array('enctype'=>'multipart/form-data'))?>
<label for="file">Archivo:</label>
<input type="file" name="file" id="file" /> 
<input type="submit" name="submit" value="Enviar" />
</form>
</div>