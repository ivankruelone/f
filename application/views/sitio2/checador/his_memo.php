            <div class="row">
                <div class="span12">
                <h4>Historico de Memorandum: </h4>
                
               
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>F. Inicio</th>
                            <th>F. Fin</th>
                            <th>Asunto</th>
                            <th>Aplico</th>
                            <th>Fecha Validacion</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php foreach($query->result() as $row){?>
                    
                    <tr>
                        <td><?php echo $row->nomina; ?></td>
                        <td><?php echo $row->completo; ?></td>
                        <td><?php echo $row->nombre; ?></td>
                        <td><?php echo $row->fec1; ?></td>
                        <td><?php echo $row->fec2; ?></td>
                        <td><?php echo $row->asunto; ?></td>
                        <td><?php echo $row->id_validacion; ?></td>
                        <td><?php echo $row->fecha_validacion; ?></td>
                    </tr>
                    
                    <?php }?>
                    
                        
                    </tbody>
                </table>
                
                <div style="text-align: center;"><?php echo $this->pagination->create_links();?></div>
                
                </div>
            </div>
                
           
            
