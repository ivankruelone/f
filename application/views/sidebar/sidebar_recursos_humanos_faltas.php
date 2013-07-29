      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('recursos_humanos/movimiento_fal', 'CAPTURA_FALTAS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_empleados_pendientes_falta', 'FALTAS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_empleados_pendientes_falta_xsup', 'FALTAS X SUP<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_entrega_recibo_his', 'HIS.FALTAS <br />', 'class="button-link blue"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>