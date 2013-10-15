     <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
echo anchor('sistemas/reportes_his', 'reportes', 'class="button-link blue"');
echo('<br /> <br />'); 
echo anchor('sistemas/reportes_depto', 'Programas', 'class="button-link blue"');
echo('<br /> <br />'); 
echo anchor('direccion/tabla_diagnostico', 'DIAGNOSTIDO DEPTOS', 'class="button-link blue"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>
