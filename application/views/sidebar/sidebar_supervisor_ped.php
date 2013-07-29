      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
if($nivel==14){
echo anchor('supervisor/pedidos', 'PEDIDOS DE ALMACEN', 'class="button-link purple"');
echo ('<br /><br />');
//echo anchor('supervisor/tabla_desplaza', 'Clasificacion de productos', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('supervisor/tabla_desplaza_nid', 'Clasificacion de productos por suc', 'class="button-link orange1"');
	
}elseif($nivel==21){
echo anchor('supervisor/pedidos_ger', 'PEDIDOS DE ALMACEN', 'class="button-link purple"');
}
	$this->load->view('sidebar/login');
?>
      </div>
