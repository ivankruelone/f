            <div class="row">
                <div class="span12">
                <h3>Reporte de venta del <?php echo $inicio;?> hasta <?php echo $inicio;?> por Folio</h3>
                <h4>Sucursal: <?php echo $nombre_sucursal; ?></h4>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th># Suc.</th>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $venta = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->sucursal; ?></td>
                            <td><?php echo $row->folio; ?></td>
                            <td><?php echo $row->fecha; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->venta, 2); ?></td>
                        </tr>
                        <?php
                        
                            $venta = $venta + $row->venta;

                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($venta, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
