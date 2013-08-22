            <div class="row">
                <div class="span12">
                
                <h4>Asistencias de correspondientes de: <?php echo $etiqueta;?></h4>
                
                <br /><br />
                
                <h5>Incidencias por faltas directas.</h5>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Compa&ntilde;ia</th>
                            <th>Departamento</th>
                            <th>N. Departamento</th>
                            <th>N. Nomina</th>
                            <th>Empleado</th>
                            <th>Sanci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        <?php 
                        
                        $faltas = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->razon; ?></td>
                            <td><?php echo $row->succ; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td><?php echo $row->nomina; ?></td>
                            <td><?php echo $row->completo; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->faltas, 0); ?></td>
                        </tr>
                        <?php
                        
                        $faltas = $faltas + $row->faltas;
                        
                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: right;">Total de incidencias</td>
                            <td style="text-align: right;" id="referencia_dias"><?php echo $faltas; ?></td>
                        </tr>
                    </tfoot>
                </table>
                </div>



                <div class="span12">
                
                <br /><br />
                
                <h5>Incidencias por acumulaci&oacute;n de retardos.</h5>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Compa&ntilde;ia</th>
                            <th>Departamento</th>
                            <th>N. Departamento</th>
                            <th>N. Nomina</th>
                            <th>Empleado</th>
                            <th>Sanci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        <?php 
                        
                        $faltas = 0;
                        
                        foreach($query2->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->razon; ?></td>
                            <td><?php echo $row->succ; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td><?php echo $row->nomina; ?></td>
                            <td><?php echo $row->completo; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->retardos, 0); ?></td>
                        </tr>
                        <?php
                        
                        $faltas = $faltas + $row->retardos
                        ;
                        
                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: right;">Total de incidencias</td>
                            <td style="text-align: right;" id="referencia_dias"><?php echo $faltas; ?></td>
                        </tr>
                    </tfoot>
                </table>
                </div>

            </div>
