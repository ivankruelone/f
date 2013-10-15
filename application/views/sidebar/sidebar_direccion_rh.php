      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('direccion/tabla_bajas', 'INCIDENCIA DE BAJAS', 'class="button-link blue"');
echo '<br /><br />';
echo anchor('direccion/reporte_jus', 'JUSTIFICACIONES A DETALLE', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/reporte_horas', 'Hrs. LABORADAS X EMPLEADO', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_diagnostico', 'DIAGNOSTIDO DEPTOS', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>