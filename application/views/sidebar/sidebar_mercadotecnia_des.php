      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_desplazamientos_lab', 'LABORATORIO<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_desplazamientos_vidaz', 'VIDAZ<br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>