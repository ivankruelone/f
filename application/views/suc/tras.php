<?php
	$row = $query->row();
?>
<br />
<p><?php echo $row->susa1?></p>

<table >
<thead>
    <tr>
        <th>CLAVE</th>
        <th>LOTE</th>
        <th>CAD</th>
        <th>PIEZAS</th>
        <th>FECHA</th>
        <th>SUC</th>
        <th>NOMBRE</th>
    </tr>
</thead>
<tbody>

<?php
	foreach($query->result() as $row)
        {
?>
<tr>
    <td>
        <?php echo $row->sec?>	   
    </td>
    <td>
        <?php echo $row->lote?>	   
    </td>	
    <td>
        <?php echo $row->cadu?>	   
    </td>		
    <td>
        <?php echo $row->can?>	   
    </td>	
    <td>
        <?php echo $row->fechai?>	   
    </td>	
    <td>
        <?php echo $row->suc?>
        <?php echo $row->sucursal?>	   
    </td>		
    <td>
        <?php echo $row->nombre?>	   
    </td>	
</tr>
    <?php
	}
?>
    

</tbody>
</table>
    
    
</form>