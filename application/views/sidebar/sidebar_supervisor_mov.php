      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
if($nivel==14){
echo anchor('supervisor/movimiento', 'MOVIMIENTOS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/movimiento_his', 'MOVIMIENTOS CAPTURADOS POR SUP.', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/movimiento_his_alta', 'LLEGADA Y BAJAS DE EMPLEADOS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/movimiento_his_alta_historico', 'HIST.DE ALTAS Y BAJAS DE EMPLEADOS<br />', 'class="button-link orange3"');
}

if($nivel==3){
echo anchor('supervisor/tabla_mov_alta', 'ENVIO EMPLEADOS A SUCURSAL<br />', 'class="button-link blue"');
echo ('<br /><br />'); 
echo anchor('supervisor/tabla_mov_val_de_sup', 'EMPLEADOS QUE LLEGARON A SUC.<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('supervisor/tabla_mov_pendiente_contador', 'MOV.DISPOSICION DE PERSONAL<br />', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('supervisor/tabla_mov_pendiente_contador_his', 'MOV.DISP.DE PERSONAL HIS<br />', 'class="button-link orange"');
echo ('<br /><br />');


}
	$this->load->view('sidebar/login');
?>
      </div>