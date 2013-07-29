<div align="center">
<h1>Inventarios de Sucursales</h1>
<div align="right">
<?php
	//echo anchor('facturas_juridico/nueva', 'Agregar nueva Factura.')
?>
</div>
<table id="tabla" class="display" cellpadding="0" cellspacing="0" border="0" style="font-size: small;">
<caption>Inventario por Clave Generica: <?php echo $query->num_rows();?></caption>
<thead>
<tr bgcolor="black">
<th>Secuencia</th>
<th>Descripcion</th>
<th>Piezas</th>
<th>Piezas</th>
<th>Consulta</th>
</tr>
</thead>
<tbody>
<?php
    $piezas = 0;
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->sec;?></td>
<td><?php echo $row->susa1;?></td>
<td align="right"><?php echo number_format($row->can, 0);?></td>
<td align="right"></td>
<td><?php echo anchor('inv/detalle/'.$row->sec, 'Detalle');?></td>
</tr>
<?php
        $piezas = $piezas + $row->can;
	}
?>
</tbody>
<tfoot>
<tr>
<td colspan="4" align="right">Total de Piezas</td>
<td align="right"><?php echo number_format($piezas, 0);?></td>
<td>&nbsp;</td>
</tr>
</tfoot>
</table>
</div>