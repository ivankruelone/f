      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==18){
echo anchor('a_traspaso/tabla_control', 'CAPTURA TRASPASOS', 'class="button-link purple"');
}
if($nivel==18 || $nivel=12){
echo anchor('a_traspaso/tabla_control_his', 'TRASPASOS HISTORICOS', 'class="button-link pink"');

echo "<br/>";
echo "<br/><strong>REPORTES DE TRASPASOS</strong><br/><br/>";
echo anchor('a_traspaso/reporte_diario', 'REPORTE DE TRASPASOS PDF', 'class="button-link red"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
