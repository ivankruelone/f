    <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('compras/tabla_orden_cedis', 'PROCESA PRE-ORDEN DE COMPRA', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('compras/tabla_compraped_cedis', 'REVISA ORDEN DE COMPRA', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('compras/tabla_compraped_cedis_entrega', 'MERCANCIA ENTREGADA EN CEDIS', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('compras/tabla_pagos_pendiente', 'PAGOS PENDIENTES', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('compras/tabla_pagos', 'PAGOS', 'class="button-link orange"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>