           <div class="row">
                <div class="span16">
                <h3>Plantilla por departamento</h3>
                
                    <?php echo form_open('checador/graba_actividad');
                  $actividad = array(
                  'name'        => 'actividad',
                  'id'          => 'actividad',
                  'value'       => '',
                  'type'        => 'text',
                  'required'   =>  'required',
                  'class'       => 'span12'
                );
                    ?>
                    
                    <fieldset>
                    <label for="empleado">Empleado:</label>
                    <?php echo form_dropdown('empleado', $empleado);?>
                    <br />
                    <label for="puesto">Puesto:</label>
                    <?php echo form_dropdown('puesto', $puesto);?>
                    <br />
                    <label>Actividad y responsabilidad: </label>
                    <?php echo form_textarea($actividad);?>
                    <br />
                    <input type="submit" name="submit" value="Guardar" class="btn" />
                    </fieldset>
                    <?php echo form_close(); ?>
                
                </div>
                
                <div class="span12">
              
               <h3>Personal</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Actividad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
               <?php
               foreach($query->result() as $row){
                $l0=anchor('checador/borrar_act/'.$row->id,'Borrar </a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                $l1=anchor('checador/actividad_actualiza/'.$row->id,'Actualizar </a>', array('title' => 'Haz Click aqui para actualizar!', 'class' => 'encabezado'));
                ?>
               
               <tr>
               <td><?php echo $l0; ?></td>
               <td><?php echo $row->nomina; ?></td>
               <td><?php echo $row->completo; ?></td>
               <td><?php echo $row->puestox; ?></td>
               <td><?php echo $row->actividad; ?></td>
               <td><?php echo $l1; ?></td>
               </tr> 
               <?php }?>
               </tbody>
               </table>
               </div> 
            
            
            </div>
