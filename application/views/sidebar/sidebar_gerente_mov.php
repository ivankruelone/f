      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('gerente/movimiento', 'MOVIMIENTOS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/movimiento_his_motivo', 'MOVI. CAPTURADOS POR SUP.', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/movimiento_his_al', 'ALTAS EMPLEADOS', 'class="button-link orange3"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>