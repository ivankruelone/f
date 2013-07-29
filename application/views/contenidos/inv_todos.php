<div align="center">
<h1>Inventarios de Sucursales</h1>
<div align="right">
<?php
	//echo anchor('facturas_juridico/nueva', 'Agregar nueva Factura.')
?>
</div>
<table id="tabla" class="display" cellpadding="0" cellspacing="0" border="0" style="font-size: medium;">
<caption>Sucursales con inventario: <?php echo $query->num_rows();?></caption>
<thead>
<tr bgcolor="black">
<th>Tipo</th>
<th>Suc</th>
<th>Nombre</th>
<th>Fecha</th>
<th>Piezas</th>
<th>Consulta</th>
</tr>
</thead>
<tbody>
<?php
    $piezas = 0;
    $inv = 0;
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->tipo2;?></td>
<td><?php echo $row->suc;?></td>
<td><?php echo $row->nombre;?></td>
<td><?php echo $row->fechai;?></td>
<td align="right"><?php echo number_format($row->can, 0);?></td>
<td><?php echo anchor('inv/detalle/'.$row->suc, 'Detalle');?></td>
</tr>
<?php
        $piezas = $piezas + $row->can;
        if($row->can == 0){
            $inv = $inv + 1;
        }
	}
?>
</tbody>
<tfoot>
<tr>
<td colspan="4" align="right">Total de Piezas</td>
<td align="right"><?php echo number_format($piezas, 0);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="right">Inventarios Faltantes</td>
<td align="right"><?php echo number_format($inv, 0);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4" align="right">Inventarios Recibidos</td>
<td align="right"><?php echo number_format($query->num_rows() - $inv, 0);?></td>
<td>&nbsp;</td>
</tr>
</tfoot>
</table>
</div>