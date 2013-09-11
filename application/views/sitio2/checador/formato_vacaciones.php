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
    

?>
            <div class="row">

<?php
    	$atributos = array('id' => 'vacaciones');
        echo form_open('checador/vacaciones_submit', $atributos);
	
?>
                <div class="span4">
                <h4>Llena el formato de vacaciones: </h4>
                
                <table>
                <tr>
                    <td>Fecha inicial: <br /><?php echo form_input($fecha1, "", 'required'); ?> </td>
                </tr>
                <tr>
                    <td>Fecha final: <br /><?php echo form_input($fecha2, "", 'required');?> </td>
                </tr>
                <tr>
                	<td><input type="submit" name="submit" value="Generar" class="btn" /></td>
                </tr>
                </table>


                <h4>Periodos</h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Periodo</th>
                            <th style="text-align: center;">Dias Otorgados</th>
                            <th style="text-align: center;">Dias</th>
                            <th style="text-align: center;">Prima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        foreach($query2->result()  as $row2){?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row2->aaa1." - ".$row2->aaa2; ?></td>
                            <td style="text-align: center;"><?php echo $row2->dias_ley; ?></td>
                            <td style="text-align: center;"><?php echo $row2->dias; ?></td>
                            <td style="text-align: center;"><?php echo $row2->prima; ?> %</td>
                        </tr>
                        <?php 
                        
                        $i = $i + $row2->dias;
                        
                        }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right;">Total</td>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                        </tr>
                    </tfoot>
                </table>
                
                <p>Fecha de ingreso: <?php echo $datos->fechaalta?></p>

                
                </div>
                
<?php
	echo form_close();
    
    $a = array('0' => 'NO', '1' => 'SI');
    
?>                
                
                <div class="span8">
                <h4>Vacaciones tomadas: </h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>F. Inicio</th>
                            <th>F. Fin</th>
                            <th>Ciclo</th>
                            <th>Dias</th>
                            <th>Validada</th>
                            <th>Aplico</th>
                            <th>Fecha</th>
                            <th>Imp.</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                    
                    $dias = 0;
                    foreach($query->result() as $row){?>
                    
                    <tr>
                        <td><?php echo $row->fec1; ?></td>
                        <td><?php echo $row->fec2; ?></td>
                        <td><?php echo $row->ciclo; ?></td>
                        <td style="text-align: right;"><?php echo $row->dias; ?></td>
                        <td style="text-align: center;"><?php echo $a[$row->validado]; ?></td>
                        <td><?php echo $row->nombre; ?></td>
                        <td><?php echo $row->fecha_validacion; ?></td>
                        <td><?php echo anchor('checador/imprime/'.$row->id, 'Imp.', array('target' => '_blank')); ?></td>
                    </tr>
                    
                    <?php 
                    
                    $dias = $dias + $row->dias;
                    }
                    
                    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Dias totales tomados</td>
                            <td style="text-align: right;"><?php echo $dias; ?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>
                
                
                </div>
                
            </div>
