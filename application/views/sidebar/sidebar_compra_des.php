      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('compras/tabla_desplaza_gral', 'DESPLAZ.SUC.GEN.DDR ', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_desplaza_modulos', 'modulos<br />', 'class="button-link blue"');
echo "<br /><br />";
echo anchor('direccion/tabla_depositos', 'Depositos', 'class="button-link blue"');
echo "<br /><br />";



	$this->load->view('sidebar/login');
?>
      </div>