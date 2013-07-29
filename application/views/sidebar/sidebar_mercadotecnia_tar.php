      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_tarjetas', 'TARJETAS<br />', 'class="button-link blue"');
echo ('<br /><br />');

echo anchor('mercadotecnia/tabla_catalogo_lab', 'Catalogo de laboratorios<br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>