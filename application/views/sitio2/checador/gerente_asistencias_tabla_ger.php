            <div class="row">
                <div class="span12">
                <h3>Asistencias correspondientes de: <?php echo $etiqueta;?></h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Depto</th>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Horario</th>
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
                        if($row->falta>0 || $row->retardo>3){$color='red';}else{$color='green';}
                        if($row->checa==0){
                            $color='blue';$fal=0;$accion=$accion=anchor('checador/gerente_detalle_empleado_periodo_ger/'.$row->empleado_id.'/'.$inicio.'/'.$fin, 'No checa');;
                            }else{
                                $fal=$row->falta;
                                $accion=anchor('checador/gerente_detalle_empleado_periodo_ger/'.$row->empleado_id.'/'.$inicio.'/'.$fin, 'Detalle');}
                        
                        ?>
                        <tr>
                            <td><font color=<?php echo $color?>><?php echo $row->depto; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $row->nomina; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $row->completo; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $row->entrada.'-'.$row->salida; ?></font></td>
                            <td style="text-align: right;"><font color=<?php echo $color?>><?php echo number_format($row->horas_decimal, 1); ?></font></td>
                            <td style="text-align: center;"><font color=<?php echo $color?>><?php echo $fal; ?></font></td>
                            <td style="text-align: center;"><font color=<?php echo $color?>><?php echo $row->retardo; ?></font></td>
                            <td style="text-align: center;"><font color=<?php echo $color?>><?php echo $row->justificada; ?></font></td>
                            <td><font color=<?php echo $color?>><?php echo $accion?></font></td>
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
                            <td colspan="4" style="text-align: right;">Totales</td>
                            <td style="text-align: right;"><?php echo number_format($horas, 1)?></td>
                            <td style="text-align: center;"><?php echo $faltas?></td>
                            <td style="text-align: center;"><?php echo $retardos?></td>
                            <td style="text-align: center;"><?php echo $justificadas?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
            
            <?php 
            
            $nivel = $this->session->userdata('nivel');
            
            if($nivel == 50){
                $this->load->view('sitio2/checador/admin_asistencias_elige');
            }else{
                $this->load->view('sitio2/checador/gerente_asistencias_elige');
            }
            
            ?>
