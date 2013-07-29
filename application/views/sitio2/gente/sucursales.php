            <div class="row">
                <div class="span12">
                <h3>Catalogo de sucursales</h3>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th># Suc.</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>CP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach($query->result() as $row){
                        
                        ?>
                        <tr>
                            <td><?php echo $row->suc; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td><?php echo $row->dire.' '.$row->col.' '.$row->pobla; ?></td>
                            <td><?php echo $row->cp; ?></td>
                        </tr>
                        <?php

                        }
                        
                        ?>
                    </tbody>
                </table>

                </div>
            </div>
