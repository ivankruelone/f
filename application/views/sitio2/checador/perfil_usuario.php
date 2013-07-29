<?php
$row = $query->row();
$a = array('0' => 'NO', '1' => 'SI');
?>
            <div class="row">
                <div class="span6">
                    <h2>Empleado</h2>
                    <p><?php echo $this->session->userdata('nombre');?></p>
                    <p><?php echo anchor('checador/cambio_password', 'Cambio de contrase&ntilde;a');?></p>

            <div id="avatar" style="margin-bottom: 10px;">
                <img src="<?php echo base_url();?>img/avatar/<?php echo $row->imagen;?>" />
            </div>

        <fieldset>
        <legend>Avatar</legend>
        <dl>
            <dt style="margin-bottom: 10px;">
                <label>Elige otro avatar:</label>
            </dt>
            <dd style="margin-bottom: 10px;">
                <button class="green medium" id="upload_button">Da click aqui para seleccionar un avatar desde arhivo.</button>
            </dd>
        </dl>
        </fieldset>

                </div>
                <div class="span6">
                    <h2>Datos</h2>
                    <p>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td># Nomina</td>
                                    <td><?php echo $this->session->userdata('nomina');?></td>
                                </tr>
                                <tr>
                                    <td>Puesto</td>
                                    <td><?php echo $this->session->userdata('puesto');?></td>
                                </tr>
                                <tr>
                                    <td>Departamento</td>
                                    <td><?php echo $this->session->userdata('nom_suc');?></td>
                                </tr>
                                <tr>
                                    <td>Compa&ntilde;ia</td>
                                    <td><?php echo $this->session->userdata('razon');?></td>
                                </tr>
                                <tr>
                                    <td>RFC</td>
                                    <td><?php echo $row->rfc;?></td>
                                </tr>
                                <tr>
                                    <td>CURP</td>
                                    <td><?php echo $row->curp;?></td>
                                </tr>
                                <tr>
                                    <td>Afiliaci&oacute;n</td>
                                    <td><?php echo $row->afiliacion;?></td>
                                </tr>
                                <tr>
                                    <td>Checa Entrada</td>
                                    <td><?php echo $a[$row->checa];?></td>
                                </tr>
                                <tr>
                                    <td>Hora Entrada</td>
                                    <td><?php echo $row->entrada;?></td>
                                </tr>
                                <tr>
                                    <td>Hora Salida</td>
                                    <td><?php echo $row->salida;?></td>
                                </tr>
                                <tr>
                                    <td>Tolerancia</td>
                                    <td><?php echo $row->tolerancia;?> Minutos</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p class="text-info">*Nota: &iquest;Tus datos estan incorrectos?, acercate al Departamento de Recursos Humanos.</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
               </div>
            </div>
