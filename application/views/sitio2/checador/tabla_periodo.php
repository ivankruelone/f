<div class="row">

<div class="span6">
                <h4>Periodos</h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Periodo</th>
                            <th style="text-align: center;">Dias</th>
                            <th style="text-align: center;">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php 
                        $i = 0;
                        foreach($query2->result()  as $row2){
                        $l= anchor('checador/editar_per/'.$row2->id, '<img src="'.base_url().'img/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para editar', 'class' => 'encabezado'));
                        
                        $nombre = $row2->completo;
                            ?>
                        
                        <tr>
                            <td style="text-align: center;"><?php echo $row2->aaa1." - ".$row2->aaa2; ?></td>
                            <td style="text-align: center;"><?php echo $row2->dias; ?></td>
                            <td style="text-align: center;"><?php echo $l; ?></td>
                            <td style="text-align: center;"><?php echo $nombre; ?></td>
                        </tr>
                        <?php 
                        
                        $i = $i + $row2->dias;
                        
                        }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right;">Total</td>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                        </tr>
                    </tfoot>
                </table>
                
</div>

</div>
