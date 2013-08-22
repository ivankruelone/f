    <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('compras/orden_lote', 'ORDEN LOTE', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('compras/tabla_inv_cedis_lote', 'INV.DE CEDIS', 'class="button-link blue"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>