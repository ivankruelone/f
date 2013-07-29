<h1>Pedidos pendientes generados en el Call Center</h1>
<div id="medicamentos" style="margin-top: 15px;">
<?php
    $sql2 = "SELECT *, p.alta as pedalta FROM cat.pedidos p
left join cat.clientes c on p.cliente_id = c.id
where p.id = ?;";
    $query2 = $this->db->query($sql2, array($id));
    $row2 = $query2->row();
?>

<h2>Datos de Cliente</h2>

Nombre: <?php echo $row2->nombre.' '.$row2->apaterno.' '.$row2->amaterno;?>
<br />
Domicilio: <?php echo $row2->calle.' '.$row2->numero.' CP '.$row2->cp.' COL. '.$row2->colonia.' '.$row2->municipio.' '.$row2->estado;?>
<br />
Generado: <?php echo $row2->pedalta?>
<table>
<thead>
<tr>
<th>Sec.</th>
<th>EAN</th>
<th>Sustancia Activa</th>
<th>Nombre Comercial</th>
<th>Piezas</th>
<th>Precio</th>
</tr>
</thead>
<tbody>
<?php
    $sql = "SELECT * FROM cat.pedidos p
left join cat.tratamientos t on p.id = t.pedido_id
where p.id = ?;";
    $query = $this->db->query($sql, array($id));
    
    foreach($query->result() as $row)
    {
        
?>
<tr>
<td><?php echo $row->sec?></td>
<td><?php echo $row->ean?></td>
<td><?php echo $row->susa?></td>
<td><?php echo $row->nomcom?></td>
<td><?php echo $row->cantidad?></td>
<td><?php echo $row->vtaddr?></td>
</tr>
<?php
	}
?>

</tbody>
</table>
</div>

