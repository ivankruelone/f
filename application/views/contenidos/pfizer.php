<h2>Pfizer Conmigo</h2>
<?php
    $data_tarjeta = array(
              'name'        => 'tarjeta',
              'id'          => 'tarjeta',
              'maxlength'   => '13',
              'size'        => '30',
              'autofocus'   => 'autofocus'
            );
    
    $data_sku = array(
              'name'        => 'sku',
              'id'          => 'sku',
              'maxlength'   => '13',
              'size'        => '30'
            );

    $data_cantidad = array(
              'name'        => 'cantidad',
              'id'          => 'cantidad',
              'type'   => 'number',
              'size'        => '30'
            );

    $data_ticket = array(
              'name'        => 'ticket',
              'id'          => 'ticket',
              'type'   => 'text',
              'size'        => '30'
            );
?>
<div align="center" id="carga_datos">
<table>
<thead>
<tr>
<th colspan="2">Carga de datos</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo form_label('Tarjeta: ');?></td>
<td><?php echo form_input($data_tarjeta, '1129999998');?></td>
</tr>
<tr>
<td><?php echo form_label('Sku: ');?></td>
<td><?php echo form_input($data_sku, '7501287670328');?></td>
</tr>
<tr>
<td><?php echo form_label('Cantidad: ');?></td>
<td><?php echo form_input($data_cantidad, '1');?></td>
</tr>
<tr>
<td><?php echo form_label('Ticket: ');?></td>
<td><?php echo form_input($data_ticket, 'V0000021568455');?></td>
</tr>
<tr>
<td colspan="2" align="center"><?php echo form_button('Evaluar', 'Evaluar', 'id="envio" class="button-link green"');?></td>
</tr>
</tbody>
</table>
</div>