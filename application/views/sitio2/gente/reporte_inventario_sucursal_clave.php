            <div class="row">
                <div class="span12">
                <h3>Inventario total por clave</h3>
                <h4>Sucursal: <?php echo $nombre_sucursal; ?></h4>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>EAn</th>
                            <th>Clave</th>
                            <th>Descripci&oacute;n</th>
                            <th>Cant.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $cantidad = 0;
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->ean; ?></td>
                            <td><?php echo $row->clave; ?></td>
                            <td><?php echo $row->descripcion; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->inv, 0); ?></td>
                        </tr>
                        <?php
                        
                            $cantidad = $cantidad + $row->inv;

                        }
                        
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($cantidad, 0); ?></td>
                        </tr>
                    </tfoot>
                </table>

                </div>
            </div>
