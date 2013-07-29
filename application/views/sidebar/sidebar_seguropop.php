<div class="sidebar">
      
      <?php
        echo ('<h2>DIF. PROCESOS</h2>');
        echo ('<br />');
        echo anchor('seguropop/tabla_seguropop', 'Comparativo compra', 'class="button-link green"');
        echo ('<br /><br />');
        echo anchor('seguropop/tabla_seguropop_prv', 'Comparativo compra_prv', 'class="button-link green"');
        echo ('<br /><br />');
        
        

      ?>
<br /><br />

<?php
	$this->load->view('sidebar/login');
?>


      </div>