<div style="width: 100%;" align="center">
<table style="font-size: large; width: 100%;">
    <thead>
        <th colspan="2">Evento ID: <?php echo $row->id; ?></th>
    </thead>
    <tbody>
        <tr>
            <td>
            <?php
            echo form_label('Titulo:', 'titulo');
            ?>
            </td>
            <td>
            <?php
            
            echo $row->titulo;
            
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Sucursal:', 'suc');
            ?>
            </td>
            <td>
            <?php
            echo $row->suc;
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Asunto:', 'asunto');
            ?>
            </td>
            <td>
            <?php
            echo $row->asunto_desc;
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Fecha:', 'fecha');
            ?>
            </td>
            <td>
            <?php
            echo $row->fecha;
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Hora de Inicio:', 'hora_inicio');
            ?>
            </td>
            <td>
            <?php
            echo $row->hora_inicio;
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Hora de Fin:', 'hora_fin');
            ?>
            </td>
            <td>
            <?php
            echo $row->hora_fin;
            ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
            Detalles:
            </td>
        </tr>

        <tr>
            <td colspan="2">
            <?php
            echo $row->detalle;
            ?>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">

            </td>
        </tr>

    </tbody>
</table>

<?php
    if($row->id_user == $this->session->userdata('id')){
	   echo anchor('bitacora/modificar_evento/'.$row->id, 'Modificar Bitacora');
    }
?>

</div>