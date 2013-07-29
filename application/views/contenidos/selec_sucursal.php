<blockquote>
    
    <p align="center"><strong>SELECCIONE LA SUCURSAL</strong></p>
  </blockquote>

<div align="center">
<?php
	echo form_open('captura_pedido1/submit');
?>
<table>


<tr>
<th colspan="8"><font size="+1" > SELECCIONE LOS DATOS SOLICITADOS </font></th>
</tr>

 <tr>
	<td>SUCURSAL: </td>
	<td align="left" colspan="3"><?php echo form_dropdown('suc', $sucursal, '', 'id="suc"') ;?> </td>
</tr>

<tr>
	<td colspan="6"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<?php
    echo form_close();
?>
</div>

<script language="javascript" type="text/javascript">
$(window).load(function () {
  $("#suc").focus();
});

</script>