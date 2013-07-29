      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('direccion/tabla_bajas', 'INCIDENCIA DE BAJAS<br />', 'class="button-link blue"');
echo '<br /><br />';
echo anchor('direccion/reporte_jus', 'JUSTIFICACIONES A DETALLE<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/reporte_horas', 'Hrs. LABORADAS X EMPLEADO<br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>