            <div class="row">
                <div class="span12">
                <h3>Asistencias de correspondientes de: <?php echo $etiqueta;?></h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Horas Acumuladas</th>
                            <th>Fal</th>
                            <th>Ret</th>
                            <th>Jus</th>
                            <th>Accion</th>
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
                        if($row->checa==0){$fal=0;}else{$fal=$row->falta;}
                        ?>
                        <tr>
                            <td><?php echo $row->succ; ?></td>
                            <td><?php echo $row->sucursal; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->horas_decimal, 1); ?></td>
                            <td style="text-align: center;"><?php echo $fal; ?></td>
                            <td style="text-align: center;"><?php echo $row->retardo; ?></td>
                            <td style="text-align: center;"><?php echo $row->justificada; ?></td>
                            <td><?php echo anchor('checador/admin_gerente_asistencias_tabla_periodo/'.$row->succ.'/'.$inicio.'/'.$fin, 'Detalle')?></td>
                        </tr>
                        <?php
                        
                        $horas = $horas + $row->horas_decimal;
                        $faltas = $faltas + $fal;
                        $retardos = $retardos + $row->retardo;
                        $justificadas = $justificadas + $row->justificada;
                        
                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;">Totales</td>
                            <td style="text-align: right;"><?php echo number_format($horas, 1)?></td>
                            <td style="text-align: center;"><?php echo $faltas?></td>
                            <td style="text-align: center;"><?php echo $retardos?></td>
                            <td style="text-align: center;"><?php echo $justificadas?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                </div>
                
                <div class="span4" id="container"> 
                
                </div>
                <div class="span4" id="container1"> 
                
                </div>
                <div class="span4" id="container2"> 
                
                </div>
            </div>
            
            <?php $this->load->view('sitio2/checador/admin_asistencias_elige');?>
