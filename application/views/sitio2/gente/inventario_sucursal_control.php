            <div class="row">
                <div class="span12">
                <h3>Inventario total por sucursal</h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Nombre</th>
                            <th>Cant.</th>
                            <th>Detalle</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $cantidad = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->sucursal; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->inv, 0); ?></td>
                            <td><?php echo anchor('gente/reporte_inventario_sucursal_producto/'.$row->sucursal, 'Producto'); ?></td>
                            <td><?php echo anchor('gente/reporte_inventario_sucursal_clave/'.$row->sucursal, 'Clave'); ?></td>
                        </tr>
                        <?php
                        
                            $cantidad = $cantidad + $row->inv;

                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($cantidad, 0); ?></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
