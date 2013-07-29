            <div class="row">
                <div class="span6">
                <h3>Elige una quincena</h3>
                
                    <?php echo form_open('checador/asistencias_tabla')?>
                    <fieldset>
                    <label for="quincena">Quincenas:</label>
                    <?php echo form_dropdown('quincena', $quincenas);?>
                    <br />
                    <input type="submit" name="submit" value="Ver Reporte" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>

                <div class="span6">
                <h3>O elige un periodo libre</h3>
                
                <?php
                
                $inicio = array(
                  'name'        => 'inicio',
                  'id'          => 'inicio',
                  'value'       => date('Y-m-d')
                );

                $fin = array(
                  'name'        => 'fin',
                  'id'          => 'fin',
                  'value'       => date('Y-m-d')
                );

                ?>
                
                    <?php echo form_open('checador/asistencias_tabla_periodo')?>
                    <fieldset>
                    <label>Elige un periodo: </label>
                    <?php echo form_input($inicio);?>
                    <br />
                    <?php echo form_input($fin);?>
                    <br />
                    <input type="submit" name="submit" value="Ver Reporte" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
            </div>
