      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

echo ('ORDEN DE COMPRA');
echo anchor('a_gerente/tabla_compraped_cedis_entrega', 'CONTROL', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('a_gerente/tabla_control_orden', 'DETALLE', 'class="button-link blue"');


?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
