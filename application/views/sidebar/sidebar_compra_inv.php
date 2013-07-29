      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('compras/tabla_inv_cedis', 'INV.DE CEDIS', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('compras/tabla_inv_farmabodega', 'INV. FARMABODEGA', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('compras/tabla_inv_segpop', 'INV.SEG.POP', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('compras/tabla_inv_genddr', 'INV.SUC.GEN.DDR', 'class="button-link orange1"');
echo ('<br /><br />');




	$this->load->view('sidebar/login');
?>
      </div>