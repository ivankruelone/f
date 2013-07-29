
                
                <div class="span12">
                <h4>Historico de Memos por validar: </h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>F. Inicio</th>
                            <th>F. Fin</th>
                            <th>Asunto</th>
                            <th>Validar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php foreach($query->result() as $row){
                    $l= anchor('checador/validar_memo/'.$row->id.'/'.$row->nomina, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'class' => 'encabezado'));
                    $l1 = anchor('checador/eliminar1/'.$row->id, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para eliminar', 'class' => 'encabezado'));
                    ?>
                    <tr>
                        <td><?php echo $row->nomina; ?></td>
                        <td><?php echo $row->completo; ?></td>
                        <td><?php echo $row->nombre; ?></td>
                        <td><?php echo $row->fec1; ?></td>
                        <td><?php echo $row->fec2; ?></td>
                        <td><?php echo $row->asunto; ?></td>
                        <td><?php echo $l; ?></td>
                        <td><?php echo $l1; ?></td>
                    </tr>
                    
                    <?php }?>
                        
                    </tbody>
                </table>
                
                <div style="text-align: center;"><?php echo $this->pagination->create_links();?></div>
                
                </div>
                
           
            
