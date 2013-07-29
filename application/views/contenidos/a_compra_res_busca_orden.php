<table>
<thead>
<?php
	$l1 = anchor('a_compra/agrega_ctl/'.$orden.'/'.$fac, 'CAPTURAR FaCTURA'.'<img src="'.base_url().'img/icon_list_style_arrow.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para capturar detalle!', 'class' => 'encabezado'));
?>
<tr>
<th colspan="5"><strong><?php echo $l1 ?></strong></th>
</tr>
<tr>
<th>Sec</th>
<th>Sustancia Activa</th>
<th>C.Solicitada</th>
<th>C.Entregada</th>
<th>C.Pendiente</th>
</tr>
</thead>
<tbody>
<?php
	foreach($query as $row){
?>
<tr>
<td><?php	echo $row->sec?></td>
<td><?php	echo $row->susa?></td>
<td align='right'><?php	echo number_format($row->cans,0)?></td>
<td align='right'><?php	echo number_format($row->aplica,0)?></td>
<td align='right'><?php	echo number_format(($row->cans-$row->aplica),0)?></td>

</tr>
<?php
	}
?>
</tbody>
</table>