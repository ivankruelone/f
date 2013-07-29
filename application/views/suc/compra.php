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
        <th>ORDEN</th>
        <th>FACTURA</th>
        <th>PROVEDOR</th>
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
        <?php echo $row->orden?>	   
    </td>	
    <td>
        <?php echo $row->fac?>   
    </td>
    <td>
        <?php echo $row->razo?>	   
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