<div align="center">
<h1>Inventario de la Sucursal</h1>
<?php
	echo $suc;
    if($sucursal == 1600 || $sucursal == 1601){
        $tipo = 'FB';
    }else{
        $tipo = 'OTRA';
    }
?>
<h2>Movimiento 07</h2>
<div align="right">
<?php
	//echo anchor('facturas_juridico/nueva', 'Agregar nueva Factura.')
?>
</div>
<table cellpadding="0" cellspacing="0" border="0" style="font-size: x-small;">
<caption>Claves en inventario: <?php echo $query->num_rows();?></caption>
<thead>
<tr bgcolor="black">
<th>Sec</th>
<th>Sustancia Activa</th>
<?php
	if($tipo == 'FB'){
?>
<th>Nombre Comercial</th>
<?php
	}
?>
<th>Piezas</th>
<th>Fecha Inv</th>
<th>Fecha Modificacion</th>
</tr>
</thead>
<tbody>
<?php
    $piezas = 0;
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->sec?></td>
<td><?php echo $row->susa1?></td>
<?php
	if($tipo == 'FB'){
?>
<td><?php echo $row->susa2?></td>
<?php
	}
?>
<td align="right"><?php echo $row->cantidad?></td>
<td><?php echo $row->fechai?></td>
<td><?php echo $row->fechag?></td>
</tr>
<?php
    $piezas = $piezas + $row->cantidad;
	}
?>
</tbody>
<tfoot>
<tr>
<?php
	if($tipo == 'FB'){
?>
<td colspan="3">Total de piezas</td>
<?php
	}else{
?>
<td colspan="2">Total de piezas</td>
<?php
	}
?>
<td align="right"><?php echo number_format($piezas, 0)?></td>
</tr>
</tfoot>
</table>


<?php
	echo $suc;
?>
<h2>Movimiento 03</h2>

<table cellpadding="0" cellspacing="0" border="0" >
<caption>Claves en inventario: <?php echo $query2->num_rows();?></caption>
<thead>
<tr bgcolor="black">
<th>EAN</th>
<th>Sustancia Activa</th>
<th>Piezas</th>
<th>Fecha Inv</th>
<th>Fecha Modificacion</th>
</tr>
</thead>
<tbody>
<?php
    $piezas = 0;
	foreach($query2->result() as $row2){
?>
<tr>
<td><?php echo $row2->codigo?></td>
<td><?php echo $row2->descripcion?></td>
<td align="right"><?php echo $row2->cantidad?></td>
<td><?php echo $row2->fechai?></td>
<td><?php echo $row2->fechag?></td>
</tr>
<?php
    $piezas = $piezas + $row2->cantidad;
	}
?>
</tbody>
<tfoot>
<tr>
<td colspan="2">Total de piezas</td>
<td align="right"><?php echo number_format($piezas, 0)?></td>
</tr>
</tfoot>
</table>


</div>