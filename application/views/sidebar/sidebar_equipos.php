      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('equipos/tabla_activos', 'RELACION DE EQUIPOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('equipos/tabla_bajas', 'RELACION DE EQUIPOS '.'<br />'.' PARA DAR DE BAJA<br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>