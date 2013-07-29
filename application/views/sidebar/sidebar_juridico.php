      <div class="sidebar">


<?php

echo anchor('juridico/tabla_rentas_agrega', 'AGREGA RENTAS <br />', 'class="button-link gray"');
echo ('<br /><br />');

echo anchor('juridico/tabla_rentas_busca', 'BUSCA ARRENDADORES <br />', 'class="button-link gray"');
echo ('<br /><br />');

echo anchor('juridico/tabla_rentas_his', 'HISTORICO ARRENDADORES <br />', 'class="button-link gray"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>
