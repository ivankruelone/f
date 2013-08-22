     <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
echo anchor('sistemas/tabla_control_reportes', 'reportes', 'class="button-link blue"');
	$this->load->view('sidebar/login');
?>
      </div>
