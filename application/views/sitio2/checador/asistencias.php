            <div class="row">
                <div class="span12">
                <h2>Ultimas eventos registrados</h2>
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Registros</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($query->result() as $row){?>
                        <tr>
                            <td><?php echo dia_de_la_semana($row->dia); ?></td>
                            <td><?php echo $row->checado; ?></td>
                            <td><?php echo $row->hora; ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                
                
                </div>
            </div>
