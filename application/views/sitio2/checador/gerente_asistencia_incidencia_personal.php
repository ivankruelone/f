<?php
	$empleado = $empleado->row();
?>
            <div class="row">
                <div class="span12">
                <h3>INCIDENCIAS DE PERSONAL</h3>
                <h4># Nomina: <span class="text-info"><?php echo $empleado->nomina;?></span></h4>
                <h4>Nombre: <span class="text-info"><?php echo $empleado->completo;?></span></h4>
                <h4>Puesto: <span class="text-info"><?php echo $empleado->puestox;?></span></h4>
                <h4>Fecha: <span class="text-info"><?php echo $registro->fecha;?></span></h4>
                
                </div>
                
                <div class="span12">
                    
                    <?php if ( $registro->falta == 1 ) {?>
                    
                    <p>Manifieste el motivo por el cual registro incidencia por <span class="text-error">FALTA</span></p>

                    <?php }else{?>
                    
                    <p>Manifieste el motivo por el cual registro incidencia por <span class="text-error">RETARDO</span></p>
                    <p>Hora de entrada: <span class="text-info"><?php echo $registro->hentrada; ?></span></p>
                    <p>Registro de entrada: <span class="text-info"><?php echo $registro->entrada; ?></span></p>
                    
                    <?php }?>
                    
                </div>
                
                <div class="span12">
                
                <?php echo form_open('checador/genera_incidencia', array('id' => 'forma-incidencias')); ?>
                
                <fieldset>
                    <legend>Justificaci&oacute;n: </legend>
                
                    
                    <?php
                    
                    foreach($justificaciones->result() as $row)
                    {
                        
                    $data = array(
                        'name'        => 'justificacion',
                        'id'          => 'justificacion'.$row->id,
                        'value'       => $row->id,
                        'style'       => 'margin:10px',
                        'alt'         => $row->justificantes
                        );
                    
                    echo form_radio($data) . $row->justifica;
                    }
                    
                    
                    
                    ?>
                    
                    <br /><br />
                    <span id="comprobantes-validos"></span>
                
                </fieldset>
                
                <fieldset>
                    <legend>Observaciones: </legend>
                    
                    <textarea rows="5" id="observaciones" name="observaciones" placeholder="Anota aqui las observaciones que consideres pertinentes..."></textarea>
                
                </fieldset>
                
                <p class="text-warning">NOTA: Todas las justificaciones deben venir documentadas seg&uacute;n sea el caso.</p>
                <p class="text-warning">NOTA: Queda a consideraci&oacute;n del &aacute;rea de Recursos Humanos si aplica o no una Justificaci&oacute;n.</p>
                
                <button type="submit" class="btn">Generar Incidencia</button>
                
                <?php echo form_hidden('id', $id); ?>
                
                <?php echo form_close(); ?>
                
                </div>
                
            </div>