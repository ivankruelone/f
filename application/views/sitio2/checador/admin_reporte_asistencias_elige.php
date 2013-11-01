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
                
                <div class="span6">
    
                    <h3>Procesar datos</h3>
    
                    <?php echo form_open('checador/do_procesar_datos', array('enctype'=>'multipart/form-data'))?>
                    <fieldset>
                        <label for="fecha1">Fecha Inicial:</label>
                        <input type="text" name="fecha1" id="fecha1" required="required" value="<?php echo date('Y-m-d')?>" /> 
                        <label for="fecha2">Fecha Final:</label>
                        <input type="text" name="fecha2" id="fecha2" required="required" value="<?php echo date('Y-m-d')?>" /> 
                        <input type="submit" name="submit" value="Procesar" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                    
                </div>

            </div>
