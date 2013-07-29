      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');


echo anchor('a_inv/tabla_control', 'INVENTARIO', 'class="button-link purple"');
echo anchor('a_inv/tabla_control_his', 'MOV.INV. POR FECHA', 'class="button-link pink"');
if($nivel==12 ){
echo anchor('a_inv/tabla_control_mod', 'MODIFICAR INV', 'class="button-link red"');
echo ('<br/><br/>');
echo anchor('a_inv/formulario_busqueda', 'MOVIMIENTOS X CLAVE', 'class="button-link green"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
