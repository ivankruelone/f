      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==24){
echo "<br/><strong>REPORTES DE SURTIDO</strong><br/><br/>";
echo anchor('a_surtido/reporte_surtido_diario', 'REPORTE SURTIDO DIARIO', 'class="button-link green"');
echo "<br/><br/>";
echo anchor('a_surtido/reporte_surtido_mensual1', 'CONCENTRADO DE PIEZAS SURTIDAS', 'class="button-link green"');
}
?>
<?php
    echo "<br/>";
	$this->load->view('sidebar/login');
?>
      </div>

