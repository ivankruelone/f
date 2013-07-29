      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
echo anchor('supervisor/ventas', 'REPORTE DE VENTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/cortes', 'CORTES DE CAJA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/cortes_comanche', 'RECARGA TELEFONICA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('supervisor/tarjetas', 'TARJETAS DE DESCUENTO', 'class="button-link orange3"');
echo ('<br /><br />');
//echo anchor('supervisor/natur', 'NATURISTAS', 'class="button-link orange3"');
//echo ('<br /><br />');
//echo anchor('supervisor/tabla_comision', 'COMISIONES', 'class="button-link orange3"');
//echo ('<br /><br />');
echo anchor('supervisor/ventas_naturistas', 'COMISIONES NATURISTAS', 'class="button-link orange3"');

	$this->load->view('sidebar/login');
?>
      </div>