                <div class="span12">
                <h4>Incidencias pendientes por validar: </h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Nomina</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Depto.</th>
                            <th>F. Incidencia</th>
                            <th>Incidencia</th>
                            <th>Justificaci&oacute;n</th>
                            <th>Status</th>
                            <th colspan="4" style="width: 500px; ">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php foreach($query->result() as $row){
                        
                        if ( $row->falta == 1 ){
                            $incidencia = "FALTA";
                        }else{
                            $incidencia = "RETARDO";
                        }
                        
                        $a = array(
                            '0' => 'Sin validar',
                            '1' => 'Aceptada',
                            '2' => 'Rechazada'
                            );
                            
                        if($row->estatus == 0 && $this->session->userdata('tipo') == 1){
                        
                            $l1 = anchor('checador/validar_incidencia/'.$row->incidencia.'/'.$row->asistencia, '<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar', 'id' => 'validar_'.$row->incidencia));
                            $l3 = anchor('checador/rechazar_incidencia/'.$row->incidencia.'/'.$row->asistencia, '<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para rechazar', 'id' => 'rechazar_'.$row->incidencia));

                        }else{
                            $l1 = null;
                            $l3 = null;
                        }
                        
                        $l2 = anchor('checador/formato_incidencias/'.$row->incidencia, '<img src="'.base_url().'img/filetype_pdf.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para imprimir', 'class' => 'encabezado', 'target' => '_blank'));
                    ?>
                    <tr>
                        <td><?php echo $row->folio; ?></td>
                        <td><?php echo $row->fecha_captura; ?></td>
                        <td><?php echo $row->nomina; ?></td>
                        <td><?php echo $row->completo; ?></td>
                        <td><?php echo $row->puestox; ?></td>
                        <td><?php echo $row->sucursal; ?></td>
                        <td><?php echo $row->fecha; ?></td>
                        <td><?php echo $incidencia; ?></td>
                        <td><?php echo $row->justifica; ?></td>
                        <td><?php echo $a[$row->estatus]; ?></td>
                        <td><?php echo $l1; ?></td>
                        <td><?php echo $l3; ?></td>
                        <td><?php echo $l2; ?></td>
                        <td>
                            <?php echo anchor('checador/gerente_comprobantes/'.$row->asistencia, '<img src="'.base_url().'img/the_documents_icon.png" border="0" width="20px" /></a>', array('id' => 'comprobantes_'.$row->asistencia)); ?>
                            
                            <?php if($this->session->userdata('tipo') == 1){?>
                            <button id="upload_button_<?php echo $row->asistencia; ?>">...</button>
                            <?php }?>
                        </td>
                    </tr>
                    
                    <?php }?>
                        
                    </tbody>
                </table>
                
                <div style="text-align: center;"><?php echo $this->pagination->create_links();?></div>
                
                </div>
                
                <div id="dialog" title="Basic dialog"></div>
                <div id="dialog2" title="Basic dialog"></div>

                
           
            
