<?php
$row = $query->row();
$a = array('0' => 'NO', '1' => 'SI');
?>
            <div class="row">
                <div class="span6">
                    <h2>Empleado</h2>
                    <p class="text-success" style="font-size: x-large; font-weight: bolder;"><?php echo $row->completo;?></p>
                    

            <div id="avatar" style="margin-bottom: 10px;">
                <img src="<?php echo base_url();?>img/avatar/<?php echo $row->imagen;?>" />
            </div>

                </div>
                <div class="span6">
                    <h2>Datos</h2>
                    <p>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td># Nomina</td>
                                    <td><?php echo $row->nomina;?></td>
                                </tr>
                                <tr>
                                    <td>Puesto</td>
                                    <td><?php echo $row->puestox;?></td>
                                </tr>
                                <tr>
                                    <td>Departamento</td>
                                    <td><?php echo $row->nombre;?></td>
                                </tr>
                                <tr>
                                    <td>Compa&ntilde;ia</td>
                                    <td><?php echo $row->ciax;?></td>
                                </tr>
                                <tr>
                                    <td>RFC</td>
                                    <td><?php echo $row->rfc;?></td>
                                </tr>
                                <tr>
                                    <td>CURP</td>
                                    <td><?php echo $row->curp;?></td>
                                </tr>
                                <tr>
                                    <td>Afiliaci&oacute;n</td>
                                    <td><?php echo $row->afiliacion;?></td>
                                </tr>
                                <tr>
                                    <td>Checa Entrada</td>
                                    <td><?php echo $a[$row->checa];?></td>
                                </tr>
                                <tr>
                                    <td>Hora Entrada</td>
                                    <td><?php echo $row->entrada;?></td>
                                </tr>
                                <tr>
                                    <td>Hora Salida</td>
                                    <td><?php echo $row->salida;?></td>
                                </tr>
                                <tr>
                                    <td>Tolerancia</td>
                                    <td><?php echo $row->tolerancia;?> Minutos</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p class="text-info">*Nota: &iquest;Tus datos estan incorrectos?, acercate al Departamento de Recursos Humanos.</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
               </div>
            </div>
            
            <div class="row">
            
                <div class="span12">
                    <h2>Vacaciones tomadas</h2>
                    <table class="table">
                    <thead>
                        <tr>
                            <th>F. Inicio</th>
                            <th>F. Fin</th>
                            <th>Ciclo</th>
                            <th>Dias</th>
                            <th>Validada</th>
                            <th>Aplico</th>
                            <th>Fecha</th>
                            <th>Imp.</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                    
                    $dias = 0;
                    foreach($vacaciones->result() as $row){?>
                    
                    <tr>
                        <td><?php echo $row->fec1; ?></td>
                        <td><?php echo $row->fec2; ?></td>
                        <td><?php echo $row->ciclo; ?></td>
                        <td style="text-align: right;"><?php echo $row->dias; ?></td>
                        <td style="text-align: center;"><?php echo $a[$row->validado]; ?></td>
                        <td><?php echo $row->nombre; ?></td>
                        <td><?php echo $row->fecha_validacion; ?></td>
                        <td><?php echo anchor('checador/imprime/'.$row->id, 'Imp.', array('target' => '_blank')); ?></td>
                    </tr>
                    
                    <?php 
                    
                    $dias = $dias + $row->dias;
                    }
                    
                    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Dias totales tomados</td>
                            <td style="text-align: right;"><?php echo $dias; ?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>

                    
                </div>
            
            </div>

            <div class="row">
            
                <div class="span12">
                    <h2>Incapacidades</h2>

                    <table class="table">
                    <thead>
                        <tr>
                            <th>F. Inicio</th>
                            <th>F. Fin</th>
                            <th>Dias</th>
                            <th>F. captura</th>
                            <th>Valido</th>
                            <th>Observaciones</th>
                            <th>Folio</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                    
                    $dias = 0;
                    foreach($incapacidades->result() as $row){?>
                    
                    <tr>
                        <td><?php echo $row->fecha_mov; ?></td>
                        <td><?php echo $row->fecha_final; ?></td>
                        <td style="text-align: right;"><?php echo $row->dias; ?></td>
                        <td><?php echo $row->fecha_c; ?></td>
                        <td><?php echo $row->rh; ?></td>
                        <td><?php echo $row->obser2; ?></td>
                        <td><?php echo $row->folio_inca; ?></td>
                    </tr>
                    
                    <?php 
                    
                    $dias = $dias + $row->dias;
                    }
                    
                    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;">Dias totales tomados</td>
                            <td style="text-align: right;"><?php echo $dias; ?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            
            </div>

            <div class="row">
            
                <div class="span12">
                    <h2>Incidencias (Empezando el registro desde el 01 de Julio de 2013)</h2>


                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th style="text-align: center;">Retardo</th>
                            <th style="text-align: center;">Falta</th>
                            <th style="text-align: center;">Justificada</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
                    
                    $retardos = 0;
                    $faltas = 0;
                    $justificadas = 0;
                    
                    $retardos_justificados = 0;
                    $faltas_justificadas = 0;
                    
                    foreach($incidencias->result() as $row){?>
                    
                    <tr>
                        <td><?php echo $row->diac; ?></td>
                        <td><?php echo $row->fecha; ?></td>
                        <td><?php echo $row->entrada; ?></td>
                        <td><?php echo $row->salida; ?></td>
                        <td style="text-align: center;"><?php echo ($row->retardo       == 1) ? '<i class="icon-remove"></i>' : ''; ?></td>
                        <td style="text-align: center;"><?php echo ($row->falta         == 1) ? '<i class="icon-remove"></i>' : ''; ?></td>
                        <td style="text-align: center;"><?php echo ($row->justificada   == 1) ? '<i class="icon-remove"></i>' : ''; ?></td>
                        <td><?php echo $row->motivo; ?></td>
                    </tr>
                    
                    <?php 
                    
                        $retardos = $retardos + $row->retardo;
                        $faltas = $faltas + $row->falta;
                        $justificadas = $justificadas + $row->justificada;
                        
                        if($row->retardo && $row->justificada)
                        {
                            $retardos_justificados = $retardos_justificados + $row->justificada;
                        }
                    
                        if($row->falta && $row->justificada)
                        {
                            $faltas_justificadas = $faltas_justificadas + $row->justificada;
                        }

                    }
                    
                    
                    
                    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right;">Incidencias Totales</td>
                            <td style="text-align: right;"><?php echo $retardos; ?></td>
                            <td style="text-align: right;"><?php echo $faltas; ?></td>
                            <td style="text-align: right;"><?php echo $justificadas; ?></td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right;">Incidencias Justificadas</td>
                            <td style="text-align: right;"><?php echo $retardos_justificados; ?></td>
                            <td style="text-align: right;"><?php echo $faltas_justificadas; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right;">Incidencias Aplicables</td>
                            <td style="text-align: right;"><?php echo $retardos - $retardos_justificados; ?></td>
                            <td style="text-align: right;"><?php echo $faltas - $faltas_justificadas; ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right;">Totales laborables formulados </td>
                            <td>Dias <i class="icon-briefcase"></i></td>
                            <td style="text-align: right;"><?php echo $empiricos->dias_laborados; ?></td>
                            <td>Horas <i class="icon-time"></i></td>
                            <td style="text-align: right;"><?php echo $empiricos->horas_laboradas; ?></td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right;">Totales laborables reales </td>
                            <td>Dias <i class="icon-briefcase"></i></td>
                            <td style="text-align: right;"><?php echo $reales->dias; ?></td>
                            <td>Horas <i class="icon-time"></i></td>
                            <td style="text-align: right;"><?php echo $reales->horas; ?></td>
                        </tr>

                    </tfoot>
                </table>
                                    
                </div>
            </div>
