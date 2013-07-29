            <div class="row">
                <div class="span12">
                <h3>Reporte de corte detalle del <?php echo $inicio;?> hasta <?php echo $inicio;?></h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th># Suc.</th>
                            <th>Nombre</th>
                            <th>Fondo</th>
                            <th>Retiro</th>
                            <th>Ventas</th>
                            <th>Total</th>
                            <th>Dinero</th>
                            <th>Faltante</th>
                            <th>Sobrante</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $ventas = 0;
                        $fondo = 0;
                        $retiro = 0;
                        $total = 0;
                        $dinero = 0;
                        $faltante = 0;
                        $sobrante = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->suc; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->fondo, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->retiro, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->ventas, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->total, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->dinero, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->faltante, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->sobrante, 2); ?></td>
                            <td style="text-align: center;"><?php echo $row->fecha; ?></td>
                        </tr>
                        <?php
                        
                            $ventas = $ventas + $row->ventas;
                            $fondo = $fondo + $row->fondo;
                            $retiro = $retiro + $row->retiro;
                            $total = $total + $row->total;
                            $dinero = $dinero + $row->dinero;
                            $faltante = $faltante + $row->faltante;
                            $sobrante = $sobrante + $row->sobrante;

                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($fondo, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($retiro, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($ventas, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($total, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($dinero, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($faltante, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($sobrante, 2); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
