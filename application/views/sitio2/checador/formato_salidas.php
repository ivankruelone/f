<div class="row">

<div class="span4">
<p><strong><font size="+1"><?php echo $titulo;?></font></strong></p>
<?php
	$atributos = array('id' => 'salida');
    echo form_open('checador/salidas_submit', $atributos);

  ?>
  
  <table>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 1: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre', $empleadox, '', 'id="nombre"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 2: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre1', $empleadox, '', 'id="nombre1"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 3: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre2', $empleadox, '', 'id="nombre2"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 4: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre3', $empleadox, '', 'id="nombre3"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>EMPLEADO 5: </strong></font></td>
	<td align="left"><?php echo form_dropdown('nombre4', $empleadox, '', 'id="nombre4"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Asunto: </strong></font></td>
    <td align="left"><?php echo form_dropdown('asunto', $asuntox, '', 'id="asunto"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>Regresara: </strong></font></td>
    <td align="left"><?php echo form_dropdown('regreso', $regresox, '', 'id="regreso"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>

  <div class="span8">
                <h4>Historico salidas: </h4>
                
                <table class="table">
  
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Asunto</th>
        <th>Regres&oacute;</th>
        <th>Fecha de elaboraci&oacute;n</th>
        <th>Imp. Formato</th>
        </tr>
        </thead>
        <tbody>
                    
        <?php 
        foreach($query->result() as $row){
            ?>
        
        <tr>
        <td><?php echo $row->sucursal; ?></td>
        <td><?php echo $this->checador_model->nombre_salida($row->busca); ?></td>
        <td><?php echo $row->asunto; ?></td>
        <td><?php echo $row->regreso; ?></td>
        <td><?php echo $row->fec_elab; ?></td>
        <td><?php echo anchor('checador/imprime1/'.$row->id_reg.'/'.$row->succ, 'Imp.', array('target' => '_blank')); ?></td>
       
        </tr>
        
                    <?php 
                    
                    }
                    
                    ?>

        </tbody>
        </table>
        
        <p style="text-align: center;"><?php echo $this->pagination->create_links();?></p>
  
</div>
</div>