            <div class="row">
                <div class="span12">
                <h3>Elige un periodo</h3>
                
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
                
                    <?php echo form_open('gente/reporte_cortes')?>
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
