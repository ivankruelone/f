<div class="sidebar">
      
      <?php
        echo ('<h2>CATALOGO</h2>');
        echo ('<br />');
        echo anchor('procesos/formulario_completo', 'Empleados', 'class="button-link red"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo1', 'Sucursal', 'class="button-link red"');
        echo ('<br /><br />');
        echo anchor('procesos/formulario_completo1', 'Productos', 'class="button-link red"');
        echo ('<br />');

      ?>
<br /><br />

<?php
	$this->load->view('sidebar/login');
?>


      </div>