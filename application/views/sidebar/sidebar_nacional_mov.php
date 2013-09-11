      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

//echo anchor('nacional/movimiento_his_falta', 'FALTAS', 'class="button-link orange3"');
//echo ('<br /><br />');
echo anchor('direccion/tabla_bajas', 'INCIDENCIA DE BAJAS<br />', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo '<br /><br />';
echo anchor('direccion/tabla_cambios', 'CAMBIO DE EMPLEADOS<br />', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo '<br /><br />';
echo anchor('nacional/movimiento_his_faltante', 'FALTANTES', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/movimiento_his_incapacidad', 'INCAPACIDAD', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/movimiento_his_prima', 'PRIMA DOM.', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/movimiento_his_FESTIVO', 'FESTIVO', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');



	$this->load->view('sidebar/login');
?>
      </div>