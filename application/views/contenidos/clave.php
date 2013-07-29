

<div align="center">
<?php
    
	echo form_open('inv/submit_inv_x_clave');
    

?>
<table>
<th colspan="2" align="center">Busqueda X Clave</th>
<tr>
	<td align="left" ><font size="+1"><strong>Clave: </strong></font></td>
	<td align="left"><?php echo form_dropdown('clave', $clave, '', 'id="clave"') ;?> </td>
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