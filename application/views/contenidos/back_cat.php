<?php
    $query = $this->db->get('catbackoffice');
    echo anchor('backoffice/actualiza_catalogo', 'Actualiza Catalogo');
?>
<table style="font-size: smaller;">
<caption>Total de Productos: <?php echo number_format($query->num_rows(), 0);?></caption>
<thead>
<tr>
<th>EAN</th>
<th>Descripcion</th>
<th>Precio</th>
<th>Linea</th>
<th>Tasa</th>
<th>Fecha</th>
</tr>
</thead>
<tbody>
<?php
	foreach($query->result() as $row){
?>
<tr>
<td><?php echo $row->ean?></td>
<td><?php echo $row->descripcion?></td>
<td align="right"><?php echo number_format($row->precio, 2)?></td>
<td><?php echo $row->linea?></td>
<td><?php echo $row->tasa?></td>
<td><?php echo $row->fecha?></td>
</tr>
<?php
	}
?>
</tbody>
</table>