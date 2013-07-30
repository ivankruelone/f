      <div class="sidebar">
<?php
echo anchor('equipos/muestra_vehiculo', 'PENDIENTES POR VALIDAR<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('equipos/vehiculos_activos', 'VEHICULOS EN USO<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('equipos/vehiculos_baja', 'PEND. ENTREGAR POR BAJA<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('equipos/relacion_vehiculos', 'REL DE VEHICULOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
//echo anchor('equipos/vehiculos_activos', 'BAJA DE VEHICULO<br />', 'class="button-link blue"');
//echo ('<br /><br />');
//echo anchor('equipos/tabla_bajas', 'RELACION DE EQUIPOS '.'<br />'.' PARA DAR DE BAJA<br />', 'class="button-link blue"');
//echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>