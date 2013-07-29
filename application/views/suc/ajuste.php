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
        <th>PIEZAS ENTRADA</th>
        <th>PIEZAS SALIDA</th>
        <th>FECHA</th>
        <th>FOLIO</th>
        <th>SUC</th>
        <th>TIPO</th>
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
        <?php echo $row->entrada?>	   
    </td>
    <td>
        <?php echo $row->salida?>	   
    </td>	
    <td>
        <?php echo $row->fecha?>	   
    </td>
    <td>
        <?php echo $row->folio?>	   
    </td>	
    <td>
        <?php echo $row->suc?>
        <?php echo $row->sucursal?>	   
    </td>
    <td>
        <?php echo $row->tipo?>	   
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