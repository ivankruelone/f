      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_notas_ofertas', 'NOTA DE OFERTAS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_nota_oferta_cod', 'NOTA POR CODIGO<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_nota_suc', 'NOTA POR SUC<br />', 'class="button-link blue"');
echo ('<br /><br />');


	$this->load->view('sidebar/login');
?>
      </div>