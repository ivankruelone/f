<div align="center">
                
                    <?php echo form_open('checador/reporte_puntualidad_moronatti')?>
                    <table>
<th colspan="2"><font size="+1">Elige una quincena</font></th>
<tr>
    <td align="left" ><b><font size="+1">Quincenas: </strong></font></td>
    <td align="left"><?php echo form_dropdown('quincena', $quincenas); ?> </td>
</tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('submit', 'Ver Reporte');?></td>
</tr>
</table>     
                

            </div>