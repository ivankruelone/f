

<?php
    $fecha1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
    $fecha2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
            
    $data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'size'        => '50',
              'type'        => 'varchar',
              'required'   =>  'required'
            );
    

?>
            <div class="row">
            
            <div class="span4">

<?php
    	$atributos = array('id' => 'memo');
        echo form_open('checador/memo_submit', $atributos);
	
?>


                
                <h4>Llena el MEMORANDUM: </h4>
                
                <table>
                <tr>
                    <td>Fecha inicial: <br /><?php echo form_input($fecha1, "", 'required'); ?> </td>
                </tr>
                <tr>
                    <td>Fecha final: <br /><?php echo form_input($fecha2, "", 'required');?> </td>
                </tr>
                <tr>
                <td>Asunto: <br /><?php echo form_dropdown('asunto', $asuntox, '', 'id="asunto"') ;?> </td>
                </tr>
                <tr>
            	<td>Observacion:<br /><?php echo form_textarea($data_obser);?></td>
                </tr>
                <tr>
                	<td><input type="submit" name="submit" value="Generar" class="btn" /></td>
                </tr>
                </table>
                
                
                
<?php
	echo form_close();
    
    
?>                
                </div>
                
                <div class="span8">
                <h4>Historico Memorandums: </h4>
                
                <table class="table">
  
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Asunto</th>
        <th>Fecha inicio</th>
        <th>Fecha termino</th>
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
        <td><?php echo $row->completo; ?></td>
        <td><?php echo $row->asunto; ?></td>
        <td><?php echo $row->fec1; ?></td>
        <td><?php echo $row->fec2; ?></td>
        <td><?php echo $row->fec_elab; ?></td>
        <td><?php echo anchor('checador/imprime2/'.$row->id.'/'.$row->succ, 'Imp.', array('target' => '_blank')); ?></td>
       
        </tr>
        
                    <?php 
                    
                    }
                    
                    ?>

        </tbody>
        </table>
        
  
</div>
                
                
                
                
                
                
                </div>
             