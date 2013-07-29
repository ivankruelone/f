            <div class="row">
                <div class="span12">
                <h3>Elige una quincena</h3>
                
                    <?php echo form_open('checador/admin_reporte_asistencias')?>
                    <fieldset>
                    <label for="quincena">Quincenas:</label>
                    <?php echo form_dropdown('quincena', $quincenas);?>
                    <label for="depto">Departamento:</label>
                    <?php echo form_dropdown('depto', $sucursales);?>
                    <br />
                    <input type="submit" name="submit" value="Ver Reporte" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>

            </div>
