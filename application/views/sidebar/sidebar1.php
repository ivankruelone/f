      <div class="sidebar">
      
      <?php
        echo ('<h2>CONFIRMACION DE PEDIDO</h2>'); 
        echo anchor('a_surtido/tabla_control1', 'CONFIRMA TU PEDIDO', 'class="button-link blue"');
        echo ('<br /><br />');
        echo ('<h2>PEDIDOS SURTIDOS</h2>');
        echo anchor('a_surtido/historico_pedidos_sucursal', 'PEDIDOS NORMALES SURTIDOS', 'class="button-link purple"');
        echo anchor('a_surtido/historico_pedidos_sucursal_especial', 'PEDIDOS ESPECIALES SURTIDOS', 'class="button-link red"');


      ?>
<br /><br />

      <?php

        echo anchor('captura_pedido', 'CAPTURA DE PEDIDO', 'class="button-link green"');

      ?>

<?php
	$this->load->view('sidebar/login');
?>


      </div>