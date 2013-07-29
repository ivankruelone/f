            <div class="row">
                <div class="span12">
                <h3>Asistencias de correspondientes de: <?php echo $etiqueta;?></h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Depto</th>
                            <th>Nomina</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $horas = 0;
                        $faltas = 0;
                        $retardos = 0;
                        $justificadas = 0;
                        $a = array('0' => 'NO', '1' => 'SI');
                        
                        foreach($query->result() as $row){
                            if($row->checa==0){$accion='No checa';$color='blue';}else{$color='red';$accion='Falta registrar su huella';}
                        ?>
                        <tr>
                            <td><font color=<?php echo $color?>><?php echo $row->sucursal; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $row->nomina; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $row->completo; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $accion; ?></font></td>
                        </tr>
                        <?php
                        
                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
            
            <?php $this->load->view('sitio2/checador/admin_asistencias_elige');?>
