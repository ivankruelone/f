      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');

//echo anchor('nacional/pedidos_ger', 'PEDIDOS DE ALMACEN', 'class="button-link purple"');
//echo (' POR REGIONAL<br />');
//echo anchor('nacional/tabla_desplaza', 'Clasificacion de productos', 'class="button-link orange1"');
//echo ('<br /><br />');
//echo anchor('nacional/tabla_desplaza_nid', 'Clasificacion de productos por suc', 'class="button-link orange1"');
echo ('GENERAL<br />');
echo anchor('nacional/tabla_desplaza_gral', 'Clasificacion de productos', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('nacional/tabla_desplaza_gral_nid', 'Clasificacion de productos por suc', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('nacional/tabla_desplaza_campa', 'Campa&ntilde;a A, B y C <br />', 'class="button-link blue"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>
