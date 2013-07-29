      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
echo anchor('gerente/pedidos_ger', 'PEDIDOS DE ALMACEN', 'class="button-link purple"');
echo ('<br /><br />');
echo anchor('gerente/tabla_desplaza', 'Clasificacion de productos', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('gerente/tabla_desplaza_nid', 'Clasificacion de productos por suc', 'class="button-link orange1"');



	$this->load->view('sidebar/login');
?>
      </div>
