      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_genera_ped', 'Generar Orden<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_genera_ped_his', 'Historico Orden<br />', 'class="button-link blue"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>