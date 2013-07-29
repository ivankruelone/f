      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
//echo anchor('direccion/tabla_cat_campa_ab', 'Campla&ntilde;a A y B<br />', 'class="button-link blue"');
//echo ('<br /><br />');
echo ('GENERAL<br />');
echo anchor('direccion/tabla_desplaza_gral', 'Clasificacion de productos', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('direccion/tabla_desplaza_gral_nid', 'Clasificacion de productos por suc', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('direccion/tabla_desplaza_campa', 'Campa&ntilde;a A, B y C <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_desplaza_modulos', 'modulos<br />', 'class="button-link blue"');
echo ('<br /><br />');
//echo ('INVENTARIOS<br />');
//echo anchor('direccion/tabla_ped_fec_todo', 'INVENTARIO DE PRODUCTOS', 'class="button-link orange1"');
echo ('PREMIOS Y COMISIONES <br />');
echo anchor('direccion/premios_dias', 'PREMIOS EN DIAS', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('direccion/comision_', 'COMISION', 'class="button-link orange1"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>