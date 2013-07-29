      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==19){
echo anchor('a_devolucion/tabla_control', 'CAPTURA DE DEVOLUCION', 'class="button-link purple"');
}
if($nivel==12 || $nivel==19){
echo anchor('a_devolucion/tabla_control_his', 'DEVOLUCION HISTORICOS', 'class="button-link pink"');

echo "<br/>";
echo "<br/><strong>REPORTES DE DEVOLUCION</strong><br/><br/>";
echo anchor('a_devolucion/reporte_diario', 'REPORTE DE DEVOLUCIONES PDF', 'class="button-link red"');
echo anchor('a_devolucion/reporte_excedente', 'REPORTE POR MOTIVO', 'class="button-link blue"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
