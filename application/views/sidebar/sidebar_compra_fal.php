      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('compras/tabla_fal_sec', 'FALTANTES POR SEC', 'class="button-link orange1"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>