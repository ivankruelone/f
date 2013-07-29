      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo ('<br /><br />'); 
echo anchor('recursos_humanos/tabla_pendiente_cambio', 'PENDIENTES DE CAMBIOS<br />', 'class="button-link red"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_pendiente_disposicion', 'PENDIENTES DE DISP. DE PERSONAL<br />', 'class="button-link red"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_pendiente_alta', 'NUMEROS DE NOMINA ASIGNADOS MAL<br />', 'class="button-link red"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>