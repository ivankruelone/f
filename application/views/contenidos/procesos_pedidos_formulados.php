

<h1>Hola mundo</h1>
<?php
	echo form_open('procesos/sumit_pedidos_formulados');
    echo "<br />";
    
    $c = array();
    
 ?>      
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
</tr>
</table>
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
    echo $tabla;
    echo $tabla1;