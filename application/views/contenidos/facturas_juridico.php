
<?php
	$query = $this->db->get('cfd');
    //id, recepcion, factura, razon_social, concepto, ingreso_brenda, ingreso_caja, num_cheque, importe, depositos, destino, observaciones, fec_cap
?>

<div align="center">
<h1>Facturas Recibidas</h1>
<div align="right">
<?php
	echo anchor('facturas_juridico/nueva', 'Agregar nueva Factura.')
?>
</div>
<table id="tabla" class="display" cellpadding="0" cellspacing="0" border="0" >
<thead>
<tr bgcolor="black">
<th>Id</th>
<th>Recepcion</th>
<th>Razon Social</th>
<th>Concepto</th>
<th>N. Factura</th>
<th>Importe</th>
<th>Dep</th>
<th>Mod</th>
</tr>
</thead>
<tbody>
<?php
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->id?></td>
<td><?php echo $row->recepcion?></td>
<td><?php echo $row->razon_social?></td>
<td><?php echo $row->concepto?></td>
<td><?php echo $row->factura?></td>
<td><?php echo $row->importe?></td>
<td><?php echo anchor('facturas_juridico/depositos/'.$row->id, 'Dep')?></td>
<td><?php echo anchor('facturas_juridico/modificar/'.$row->id, 'Mod')?></td>
</tr>
<?php
	}
?>
</tbody>
</table>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
				$('#tabla').dataTable({ 'sPaginationType':'full_numbers', "oLanguage": {
    "sProcessing":   "Procesando...",
    "sLengthMenu":   "Mostrar _MENU_ registros",
    "sZeroRecords":  "No se encontraron resultados",
    "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
    "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
    "sInfoPostFix":  "",
    "sSearch":       "Buscar:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Primero",
        "sPrevious": "Anterior",
        "sNext":     "Siguiente",
        "sLast":     "Ultimo"
    }
} });
			} );
</script>