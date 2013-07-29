      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('catalogo_ger/tabla_cambios_precios', 'CAMBIOS DE PRECIOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_clasifica', 'CLASIFICACION SEC', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('compras/tabla_cat_generico', 'PRODUCTOS GEN.DDR', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('compras/tabla_cat_fenix', 'PRODUCTOS FENIX', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('compras/tabla_cat_suc', 'SUCURSALES', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('compras/tabla_cat_nat', 'PRODUCTOS NATURISTAS', 'class="button-link orange3"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>