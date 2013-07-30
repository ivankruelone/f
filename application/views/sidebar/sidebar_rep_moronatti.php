      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('direccion/reporte_puntualidad', 'REPORTE PUNTUALIDAD<br />', 'class="button-link blue"');
echo '<br /><br />';

	$this->load->view('sidebar/login');
?>
      </div>