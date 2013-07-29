<?php
	$row = $query->row();
?>
<br />
<p><?php echo $row->susa1?></p>

<table >
<thead>
    <tr>
        <th>FOLIO</th>
        <th>CLAVE</th>
        <th>CAD</th>
        <th>LOTE</th>
        <th>CANTIDAD</th>
        <th>FECHA</th>
        <th>SUCURSAL</th>
    </tr>
</thead>
<tbody>

<?php
	foreach($query->result() as $row)
        {
?>
<tr>
    <td>
        <?php echo $row->fol?>	   
    </td>
    <td>
        <?php echo $row->sec?>	   
    </td>	
    <td>
        <?php echo $row->cadu?>	   
    </td>		
    <td>
        <?php echo $row->lote?>	   
    </td>
    <td>
        <?php echo $row->can?>	   
    </td>
    <td>
        <?php echo $row->fecha?>	   
    </td>
    <td>
        <?php echo $row->sucursal?>
        <?php echo $row->sucursal1?>
        <?php echo $row->nombre?>
        <?php echo $row->nombre1?>	   
    </td>	
</tr>
    <?php
	}
?>
    

</tbody>
</table>
    
    
</form>