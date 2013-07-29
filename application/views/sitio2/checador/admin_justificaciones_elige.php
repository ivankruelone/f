            <div class="row">
                
                <div class="span6">
                <h3>Elige una quincena</h3>
                
                    <?php echo form_open('checador/reporte_justificaciones')?>
                    <fieldset>
                    <label for="quincena">Quincenas:</label>
                    <?php echo form_dropdown('quincena', $quincenas);?>
                    <br />
                    <input type="submit" name="submit" value="Ver Reporte" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>

            </div>
