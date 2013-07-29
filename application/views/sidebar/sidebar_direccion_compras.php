      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('direccion/tabla_compara', 'COMPARACION<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_segpop', 'CAT.SEGPOP <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_cedis', 'CAT.CEDIS <br />', 'class="button-link blue"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>