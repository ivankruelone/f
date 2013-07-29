      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_compra_ofertas', 'nota de Ofertas<br />', 'class="button-link blue"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>