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
echo anchor('cat_generico/tabla_catalogo_espe', 'PRODUCTOS ESPECIALIDAD', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('cat_generico/tabla_catalogo_general_cla', 'POR CLAVES GOBIERNO', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('cat_generico/tabla_catalogo_general_sec', 'POR SECUENCIA', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('cat_generico/tabla_catalogo_general_registro', 'CHECAR REGISTROS', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>