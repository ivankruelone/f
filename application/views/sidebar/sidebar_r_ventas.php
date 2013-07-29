      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==12){
echo "<br/><strong>REPORTE DE VENTAS</strong><br/><br/>";
echo anchor('r_ventas/reporte_diario', 'REPORTES DE VENTAS x Sucursal', 'class="button-link red"');
}
?>
<?php
    echo "<br/>";
	$this->load->view('sidebar/login');
?>
      </div>
