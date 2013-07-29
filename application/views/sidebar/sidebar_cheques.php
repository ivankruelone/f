      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
echo anchor('catalogo/tabla_control_arrendatario', 'CATALOGO DE ARRENDADORES<br />', 'class="button-link blue"');

if($nivel==999 ){
echo "<strong><br />CAPTURA DE CHEQUES</strong>";
echo anchor('cheques/tabla_control', 'CHEQUES <br />', 'class="button-link red"');
echo anchor('cheques/tabla_control_varios', 'CHEQUES VARIAS SUCURSALES <br />', 'class="button-link blue"');
echo anchor('cheques/tabla_control_historico', 'CHEQUES HISTORICOS <br />', 'class="button-link green"');
echo anchor('cheques/tabla_control_poliza', 'CONTROL DE POLIZAS <br />', 'class="button-link red"');
}
if($nivel==999){
echo "<strong><br />MODIFICAR POLIZAS</strong>";    
echo anchor('cheques/tabla_control_poliza_mod', 'MODIFICAR CHEQUES <br />', 'class="button-link red"');
}

?>

<?php
	$this->load->view('sidebar/login');
?>
      </div>
