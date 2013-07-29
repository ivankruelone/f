      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');	
"
<table>
<tr>";
echo anchor('cortes/tabla_plantilla', 'PLANTILLA', 'class="button-link purple"');

?>

<?php
	$this->load->view('sidebar/login');
?>
      </div>
