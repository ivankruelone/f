      <div class="sidebar">


<?php

echo anchor('juridico/tabla_rentas_genera', 'GENERA RENTAS DEL MES <br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('juridico/tabla_rentas_mensual', 'VISUALIZAR RENTAS DEL MES <br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('juridico/tabla_rentas_mensual_historico', 'VISUALIZAR RENTAS DEL MES HISTORICO<br />', 'class="button-link green"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>
