      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');	
"
<table>
<tr>";
echo anchor('cortes/tabla_control_reportes_faltantes', 'Reporte Faltante y Credito', 'class="button-link purple"');

?>

<?php
	$this->load->view('sidebar/login');
?>
      </div>
