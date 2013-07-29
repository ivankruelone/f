      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
if($tipo<2){
echo anchor('recursos_humanos/tabla_mov_supervisor', 'MOV.SUPERVISOR PENDIENTES<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_mov_supervisor_his', 'MOV.SUPERVISOR VALIDADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/busqueda_empleado_gral', 'BUSCAR EMPLEADO', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('recursos_humanos/plantilla_sup', 'PLANTILLA POR SUPERVISOR', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
//echo anchor('recursos_humanos/tabla_mov_alta', 'ENVIO EMPLEADOS A SUCURSAL<br />', 'class="button-link blue"');
//echo ('<br /><br />');
//echo anchor('recursos_humanos/tabla_mov_alta_llegaron', 'HISTORICO ENVIO EMPLEADOS A SUCURSAL<br />', 'class="button-link blue"');
//echo ('<br /><br />');
}
if($tipo==5 || $tipo==3){
echo anchor('recursos_humanos/tabla_empleados_pendientes_his', 'ALTAS Y BAJA DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/movimiento_ab_his_cla', 'HIS.ALTAS DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
}
if($tipo==6){
echo anchor('recursos_humanos/movimiento_inca', 'CAPTURA_INCAPACIDADES<br />', 'class="button-link blue"');
echo ('<br /><br />');
//echo anchor('recursos_humanos/tabla_empleados_pendientes_incapa', 'INCAPACIDADES<br />', 'class="button-link blue"');
//echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_empleados_pendientes_incapa_xsup', 'INCAPACIDAD X SUP<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_entrega_recibo_his', 'HIS.DE INCAPACIDADES<br />', 'class="button-link blue"');
echo ('<br /><br />');
}
if($tipo==7){
echo anchor('recursos_humanos/plantilla_sup', 'PLANTILLA POR SUPERVISOR', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
}
	$this->load->view('sidebar/login');
?>
      </div>