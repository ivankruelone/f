<div align="center">
<p>Si la fecha de tu inventario es la solicitada, eso indica que tu inventario lo recibimos correctamente y lo confirma: MARCO ANTONIO ZACARIAS L&Oacute;PEZ</p>
<h1>Inventario de Sucursal <?php
	echo $this->session->userdata('suc')." ".$this->session->userdata('nom_suc');
?></h1>
<div align="right">

</div>
<table id="tabla" class="display" cellpadding="0" cellspacing="0" border="0" style="font-size: medium;">

<thead>
<tr bgcolor="black">
<th>Tipo</th>
<th>Suc</th>
<th>Nombre</th>
<th>Fecha Inventario</th>
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
<td align="center"><?php echo $row->fechai;?></td>
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
</table>

</div>