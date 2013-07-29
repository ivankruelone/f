      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
echo anchor('nacional/ventas', 'REPORTE DE VENTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('nacional/cortes', 'CORTES DE CAJA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('nacional/cortes_comanche', 'RECARGA TELEFONICA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('nacional/tarjetas', 'TARJETAS DE DESCUENTO', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('nacional/natur', 'NATURISTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('nacional/tabla_comision', 'COMISIONES', 'class="button-link orange3"');

	$this->load->view('sidebar/login');
?>
      </div>