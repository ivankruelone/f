        <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('backoffice/catalogo', 'Catalogo de Backoffice <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('backoffice/tabla_catalogo', 'Catalogo de Ofertas<br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>
