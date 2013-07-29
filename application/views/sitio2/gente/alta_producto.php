            <div class="row">
                <div class="span12">
                <h3>Captura los siguientes datos.</h3>
                
                <?php
                
                $clave = array(
                  'name'        => 'clave',
                  'id'          => 'clave',
                  'required'    => 'required',
                  'placeholder' => 'Clave',
                  'maxlength'   => '14',
                );

                $ean = array(
                  'name'        => 'ean',
                  'id'          => 'ean',
                  'placeholder' => 'EAn o codigo de barras',
                  'maxlength'   => '14',
                );

                $descripcion = array(
                  'name'        => 'descripcion',
                  'id'          => 'descripcion',
                  'required'    => 'required',
                  'placeholder' => 'Descripcion',
                  'maxlength'   => '255',
                );

                $precio = array(
                  'name'        => 'precio',
                  'id'          => 'precio',
                  'required'    => 'required',
                  'placeholder' => 'Precio',
                  'maxlength'   => '8',
                  'value'       => '10.00',
                  'type'        => 'number',
                );

                ?>
                
                    <?php echo form_open('gente/alta_producto_submit')?>
                    <fieldset>
                    <label for="clave">Clave: </label>
                    <?php echo form_input($clave);?>
                    <br />
                    <label for="ean">EAN: </label>
                    <?php echo form_input($ean);?>
                    <br />
                    <label for="descripcion">Descripcion: </label>
                    <?php echo form_input($descripcion);?>
                    <br />
                    <label for="precio">Precio: </label>
                    <?php echo form_input($precio);?>
                    <br />
                    <input type="submit" name="submit" value="Aceptar" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
            </div>
