            <div class="row">
                <div class="span12">
                <h3>Asistencias de correspondientes de: <?php echo $etiqueta;?></h3>
                <h4># Nomina: <?php echo $this->session->userdata('nomina');?></h4>
                <h4>Nombre: <?php echo $this->session->userdata('nombre');?></h4>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Fecha(AMD)</th>
                            <th>Ent</th>
                            <th>Sal</th>
                            <th>TT H:M</th>
                            <th>TT Dec</th>
                            <th>Fal</th>
                            <th>Ret</th>
                            <th>Jus</th>
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
                        
                        ?>
                        <tr>
                            <td><?php echo dia_de_la_semana($row->dia); ?></td>
                            <td><?php echo $row->fecha; ?></td>
                            <td><?php echo $row->entradah; ?></td>
                            <td><?php echo $row->salidah; ?></td>
                            <td><?php echo $row->horas_tiempo; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->horas_decimal, 1); ?></td>
                            <td style="text-align: center;"><?php echo $a[$row->falta]; ?></td>
                            <td style="text-align: center;"><?php echo $a[$row->retardo]; ?></td>
                            <td style="text-align: center;"><?php echo $a[$row->justificada]; ?></td>
                        </tr>
                        <?php
                        
                        $horas = $horas + $row->horas_decimal;
                        $faltas = $faltas + $row->falta;
                        $retardos = $retardos + $row->retardo;
                        $justificadas = $justificadas + $row->justificada;
                        
                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: right;">Totales</td>
                            <td style="text-align: right;" id="horas_trabajadas"><?php echo $horas; ?></td>
                            <td style="text-align: center;" id="faltas"><?php echo $faltas; ?></td>
                            <td style="text-align: center;" id="retardos"><?php echo $retardos; ?></td>
                            <td style="text-align: center;" id="justificadas"><?php echo $justificadas; ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;">Horas a trabajar en el periodo</td>
                            <td style="text-align: right;" id="referencia_horas"><?php echo $horas_laboradas; ?></td>
                            <td style="text-align: center;" colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;">Dias a trabajar en el periodo</td>
                            <td style="text-align: right;" id="referencia_dias"><?php echo $dias_laborados; ?></td>
                            <td colspan="3">&nbsp;</td>
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
            
            <?php $this->load->view('sitio2/checador/asistencias_elige');?>
