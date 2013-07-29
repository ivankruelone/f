      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('compras/tabla_des_genddr_compra', 'COMPRA SUGERIDA CEDIS', 'class="button-link orange1"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>