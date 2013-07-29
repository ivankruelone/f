      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==8 || $nivel=9){
echo anchor('audita/tabla_control_cortes', 'SUCURSALES ', 'class="button-link blue"');
echo ('<br /><br />');
}
if($nivel==8){
echo anchor('catalogo/catalogo_usuarios_cortes', 'CATALOGO DE CORTES ', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('audita/tabla_depositos', 'DEPOSITOS', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('audita/calculo_comision', 'CORTES MENSUAL ', 'class="button-link blue"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
