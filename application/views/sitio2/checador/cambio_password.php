            <div class="row">
                <div class="span6">
                    <h2>Cambio de Contrase&ntilde;a</h2>

                    <?php echo form_open('checador/do_cambio_password')?>
                    <fieldset>
                    <label for="password_actual">Contrase&ntilde;a actual:</label>
                    <input type="password" name="password_actual" id="password_actual" /> 
                    <label for="password_nuevo1">Contrase&ntilde;a nueva:</label>
                    <input type="password" name="password_nuevo1" id="password_nuevo1" /> 
                    <label for="password_nuevo2">Contrase&ntilde;a nueva:</label>
                    <input type="password" name="password_nuevo2" id="password_nuevo2" />
                    <hr />
                    <input type="submit" name="submit" value="Cambiar" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>

                </div>
            </div>
