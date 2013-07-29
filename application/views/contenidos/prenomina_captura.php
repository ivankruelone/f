<h2>Captura los datos de tu prenomina.</h2>
<div id="tabla_datos" align="center">
<?php
	echo $datos_periodo;
?>
</div>

<div align="center">

<?php
	echo form_open('prenomina/submit_prenomina_captura');
?>
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
<table>
<thead>
<th>Empleado</th>
<th>Cuenta</th>
<th>Dato</th>
<th>Total</th>
</thead>

<tbody>
<tr>
<td>
<?php
	$data_nomina = array(
              'name'        => 'nomina',
              'id'          => 'nomina',
              'maxlength'   => '10',
              'size'        => '10',
              'required'    => 'required',
              'autofocus'   => 'autofocus'
            );

    echo form_input($data_nomina,  "", 'style="text-align: right;');
?>
</td>
<td>
<?php
    echo form_dropdown('cuenta', $cuenta);	
?>
</td>
<td>
<?php
	$data_dato = array(
              'name'        => 'dato',
              'id'          => 'dato',
              'maxlength'   => '10',
              'size'        => '10',
              'required'    => 'required'
            );

    echo form_input($data_dato);
?>
</td>
<td>
<?php
	$data_total = array(
              'name'        => 'total',
              'id'          => 'total',
              'maxlength'   => '10',
              'size'        => '10',
              'required'    => 'required'
            );

    echo form_input($data_total);
?>
</td>
</tr>
</tbody>
</table>

<input type="submit" value="Insertar" class="button-link blue"/>
<?php
	echo form_close();
?>
</div>
<div id="tabla_prenomina" align="center">
<?php
	echo $datos_prenomina;
?>
</div>
<script language="javascript" type="text/javascript">
    function formatItem(row) {
		return row[0] + " (<strong>" + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0];
	}
    
	$("#nomina").autocomplete("<?php echo site_url();?>/prenomina/nomina", {
		width: 100,
		matchContains: false,
		mustMatch: false,
		minChars: 2,
		formatItem: formatItem,
		formatResult: formatResult,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

</script>



