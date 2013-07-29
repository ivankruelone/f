            <div class="row">
                <div class="span12">
                <h3>Catalogo de productos</h3>
                
                <h5><?php echo anchor('gente/alta_producto', 'Dar de alta un nuevo producto');?></h5>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Clave</th>
                            <th>EAN</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Ultima modificacion</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->clave; ?></td>
                            <td style="text-align: right;"><?php echo $row->ean; ?></td>
                            <td><?php echo $row->descripcion; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->precio, 2); ?></td>
                            <td><?php echo $row->cambio; ?></td>
                            <td><?php echo anchor('gente/cambia_producto/'.$row->id, 'Modificar')?></td>
                        </tr>
                        <?php

                        }
                        
                        ?>
                    </tbody>
                </table>

                </div>
            </div>
