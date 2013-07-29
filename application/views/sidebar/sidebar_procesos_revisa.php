<div class="sidebar">
      
      <?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

       
        echo ('<br />');
        echo anchor('procesos/tabla_prenomina_revisa', 'PRENOMINA', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('procesos/tabla_plantilla_revisa', 'PLANTILLA', 'class="button-link green"');
        echo ('<br /><br />');
        echo ('<br /><br />');
        

      ?>
<br /><br />

<?php
	$this->load->view('sidebar/login');
?>


      </div>