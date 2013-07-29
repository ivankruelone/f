<?php
	$sql = "select s.suc, nombre, ifnull(sum(cantidad), 'PENDIENTE') as can, fechai from catalogo.sucursal s
left join desarrollo.inv i on s.suc = i.suc and (fechai = date(now()) or fechai = date(DATE_SUB(now(), INTERVAL 1 DAY)))
where s.back = 1
group by s.suc";
    $query = $this->db->query($sql);
?>
<table style="font-size: medium;">
<caption>Total de Sucursales: <?php echo $query->num_rows();?></caption>
<thead>
<tr>
<th>Suc</th>
<th>Nombre</th>
<th>Fecha</th>
<th>Piezas</th>
</tr>
</thead>
<tbody>
<?php
    $piezas = 0;
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->suc?></td>
<td><?php echo $row->nombre?></td>
<td><?php echo $row->fechai?></td>
<td align="right"><?php echo number_format($row->can, 0)?></td>
</tr>
<?php
        $piezas = $piezas + $row->can;
	}
?>
</tbody>
<tfoot>
<tr>
<td colspan="3" align="right">Total de Piezas</td>
<td align="right"><?php echo number_format($piezas, 0)?></td>
</tr>
</tfoot>
</table>