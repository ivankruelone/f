      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==8 || $nivel==10){
echo anchor('pedido/tabla_control', 'PEDIDOS ALMACEN', 'class="button-link purple"');
echo anchor('pedido/tabla_control_his', 'PEDIDOS ALMACEN HISTORICOS', 'class="button-link red"');
//echo anchor('pedido/tabla_control_envio', 'ENVIA PEDIDOS ', 'class="button-link purple"');
echo anchor('pedido/tabla_control_12', 'SUCURSALES 12 PM', 'class="button-link purple"');
}
if($nivel==9 || $nivel==20 || $nivel==30 || $nivel==34 || $nivel==24){
echo anchor('pedido/tabla_control', 'PEDIDOS ALMACEN', 'class="button-link pink"');
echo anchor('pedido/tabla_control_pendientes', 'PEDIDOS PENDIENTES', 'class="button-link green"');
echo anchor('pedido/tabla_pedidos_dia', 'PEDIDOS POR DIA', 'class="button-link red"');
}
if($nivel==11){
echo anchor('pedido/tabla_control', 'PEDIDOS ALMACEN', 'class="button-link pink"');
}
?>

<?php
	$this->load->view('sidebar/login');
?>

      </div>
