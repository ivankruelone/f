      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('recursos_humanos/tabla_nomina_entrega', 'ENTREGA NOMINA<br />', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>