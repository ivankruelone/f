      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
echo anchor('gerente/ventas', 'REPORTE DE VENTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/cortes', 'CORTES DE CAJA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/cortes_comanche', 'RECARGA TELEFONICA', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/tarjetas', 'TARJETAS DE DESCUENTO', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/natur', 'NATURISTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('gerente/tabla_comision', 'COMISIONES', 'class="button-link orange3"');

	$this->load->view('sidebar/login');
?>
      </div>