           <div class="row">
                <div class="span16">
                <h3>Plantilla por departamento</h3>
                <?php $row = $query->row();  
                ?>
                    <?php echo form_open('checador/act_actividad');
                  $actividad = array(
                  'name'        => 'actividad',
                  'id'          => 'actividad',
                  'value'       => $row->actividad,
                  'type'        => 'text',
                  'required'   =>  'required',
                  'class'       => 'span12'
                );
                    ?>
                    
                    <fieldset>
                    <label for="empleado">Empleado:</label>
                    <?php echo $row->completo;?>
                    <br />
                    <label for="puesto">Puesto:</label>
                    <?php $row->puestox;?>
                    <br />
                    <label>Actividad: </label>
                    <?php echo form_textarea($actividad);?>
                    <br />
                    <input type="submit" name="submit" value="Guardar" class="btn" />
                    </fieldset>
                    <input type="hidden" value="<?php echo $row->id?>" name="id" id="id" />
                    <?php echo form_close(); ?>
                
                </div>
            </div>
