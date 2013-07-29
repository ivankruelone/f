            <div class="row">
                <div class="span12">
                <h3>Reporte de venta del <?php echo $inicio;?> hasta <?php echo $inicio;?></h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th># Suc.</th>
                            <th>Nombre</th>
                            <th>Venta</th>
                            <th colspan="3">Ver Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $venta = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->suc; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->venta, 2); ?></td>
                            <td style="text-align: center;"><?php echo anchor('gente/reporte_venta_sucursal_folio/'.$row->suc.'/'.$inicio.'/'.$fin, 'Folio')?></td>
                            <td style="text-align: center;"><?php echo anchor('gente/reporte_venta_sucursal_producto/'.$row->suc.'/'.$inicio.'/'.$fin, 'Producto')?></td>
                            <td style="text-align: center;"><?php echo anchor('gente/reporte_venta_sucursal_ticket/'.$row->suc.'/'.$inicio.'/'.$fin, 'Ticket')?></td>
                        </tr>
                        <?php
                        
                            $venta = $venta + $row->venta;

                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($venta, 2); ?></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
