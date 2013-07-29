      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('compras/tabla_ped_fec_ceros', 'PEDIDOS FORMULADOS INV=0', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('compras/tabla_ped_fec_exc', 'PEDIDOS FORMULADOS EXC', 'class="button-link orange1"');
echo ('<br /><br />');
echo anchor('compras/tabla_ped_fec_todo', 'PEDIDOS FORMULADOS TODO', 'class="button-link orange1"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>