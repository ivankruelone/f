    <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('medicos/tabla_medicos_cat', 'CATALOGO DE MEDICOS', 'class="button-link blue"');
echo ("<br /><br />");
echo anchor('medicos/tabla_medicos_nat', 'MEDICOS VTA NATURISTAS', 'class="button-link blue"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>