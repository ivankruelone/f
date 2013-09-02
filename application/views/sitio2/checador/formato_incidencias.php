<table style="width: 100%; padding-top: 20px;" border="1">

<tr>
    <td rowspan="2"><img style="position:relative; width:150px;" src="<?php echo base_url();?>imagenes/logo1.png" /></td>
    <td rowspan="2">INCIDENCIAS DE PERSONAL</td>
    <td style="width: 20%; text-align: center;">No. Folio</td>
</tr>
<tr>
    <td style="width: 20%; text-align: center;"><b><?php echo $incidencia->folio; ?></b></td>
</tr>

<tr>
    <td colspan="3"><hr /></td>
</tr>

<tr>
    <td style="width: 20%;">NOMBRE: </td>
    <td colspan="2" style="width: 80%;"><b><?php echo $incidencia->completo; ?></td>
</tr>

<tr>
    <td style="width: 25%;">NO. NOMINA</td>
    <td style="width: 50%;">PUESTO</td>
    <td style="width: 25%;">FECHA</td>
</tr>

<tr>
    <td style="width: 25%;"><?php echo $incidencia->nomina; ?></td>
    <td style="width: 50%;"><?php echo $incidencia->puestox; ?></td>
    <td style="width: 25%;"><?php echo $incidencia->fecha_captura; ?></td>
</tr>

<tr>
    <td colspan="3">MANIFIESTO EL MOTIVO POR EL CUAL REGISTRE INCIDENCIA POR <?php if ( $incidencia->falta  == 1){ echo "FALTA"; }else{ echo "RETARDO";} ?> EL DIA <?php echo $incidencia->fechad?> DEL MES DE <?php echo nombre_del_mes($incidencia->fecham); ?> DEL <?php echo $incidencia->fechay; ?>.</td>
</tr>

<tr>
    <td colspan="3"><?php echo $incidencia->justifica; ?></td>
</tr>

<tr>
    <td colspan="3"><?php echo $incidencia->justificantes; ?></td>
</tr>

<tr>
    <td colspan="3">OBSERVACIONES: </td>
</tr>

<tr>
    <td colspan="3"><?php echo $incidencia->observaciones; ?></td>
</tr>

<tr>
    <td colspan="3">TODAS LAS JUSTIFICACIONES DEBEN VENIR DOCUMENTADAS</td>
</tr>

</table>