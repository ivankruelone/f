      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==17){
echo anchor('a_compra/tabla_control', 'CAPTURA DE FACTURAS', 'class="button-link purple"');
echo anchor('a_compra/tabla_control_patente', 'CAPTURA DE FACTURAS DE PATENTE', 'class="button-link purple"');
}
if($nivel==17 || $nivel=12){
echo anchor('a_compra/tabla_control_his', 'FACTURAS HISTORICOS', 'class="button-link pink"');
echo anchor('a_compra/imprime_compra_producto', 'REPORTE POR PRODUCTO', 'class="button-link orange"');
echo anchor('a_compra/imprime_compra_factura', 'REPORTE POR FACTURA', 'class="button-link orange"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
