<?php
	$row = $query->row();
    $a = array('0' => 'NO', '1' => 'SI');
?>
<div>

<table class="table" style="font-size: small;">
    <tbody>
    <tr>
        <td>Fecha</td>
        <td><?php echo $row->fecha; ?></td>
    </tr>
    <tr>
        <td>Entrada</td>
        <td><?php echo $row->entradah; ?></td>
    </tr>
    <tr>
        <td>Salida</td>
        <td><?php echo $row->salidah; ?></td>
    </tr>
    <tr>
        <td>Falta</td>
        <td><?php echo $a[$row->falta]; ?></td>
    </tr>
    <tr>
        <td>Retardo</td>
        <td><?php echo $a[$row->retardo]; ?></td>
    </tr>
    <tr>
        <td>Justificada</td>
        <td><?php echo $a[$row->justificada]; ?></td>
    </tr>
    </tbody>
</table>

</div>