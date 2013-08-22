<?php
	$empleado = $empleado->row();
?>
            <div class="row">
                <div class="span12">
                <h3>Asistencias de correspondientes de: <?php echo $etiqueta;?></h3>
                <h4># Nomina: <?php echo $empleado->nomina;?></h4>
                <h4>Nombre: <?php echo $empleado->completo;?></h4>
                
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
                            <th>Mot</th>
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
                        $tope=substr($etiqueta,0,5).str_pad((date('m')-1),2,'0',STR_PAD_LEFT).'-'.date('d');
                        $ini=substr($etiqueta,0,10);
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
                            <td style="text-align: center;" id="in_justificada_<?php echo $row->id_registro; ?>"><?php echo $a[$row->justificada]; ?></td>
                            <td id="in_motivo_<?php echo $row->id_registro; ?>"><?php echo $row->motivo; ?></td>
                            <td id="in_link_<?php echo $row->id_registro; ?>">
                            
                            <?php 
                            $tope=0;
                            if($tope<$ini & $this->session->userdata('tipo')== 0  and $tope>0 or ($this->session->userdata('nivel')==50) ){
                            if($row->falta == 1 || $row->retardo == 1 ){
                                
                                if($row->justificada == 0 ){
                                    echo anchor('checador/gerente_justificar/'.$row->id_registro, 'Just.', array('id' => 'justifica_'.$row->id)); 
                                }else{
                                    echo anchor('checador/gerente_justificar_quita/'.$row->id_registro, 'No Just.', array('id' => 'quita_'.$row->id)); 
                                }
                                
                                ?>
                                
                                <button id="upload_button_<?php echo $row->id_registro; ?>">Comprobante</button>
                                <?php
                            
                                    echo anchor('checador/gerente_comprobantes/'.$row->id_registro, 'Comp.', array('id' => 'comprobantes_'.$row->id)); 
                            }
                            }
                            ?>
                            
                            </td>
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
                            <td style="text-align: right;"><?php echo number_format($horas, 1)?></td>
                            <td style="text-align: center;"><?php echo $faltas?></td>
                            <td style="text-align: center;"><?php echo $retardos?></td>
                            <td style="text-align: center;"><?php echo $justificadas?></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>

                </div>
                
                <div id="dialog" title="Basic dialog">
                <div id="dialog2" title="Basic dialog">
                </div>
                
            </div>
