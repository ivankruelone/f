      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

echo ('Inventarios<br />');
echo anchor('a_gerente/tabla_inventario', 'INVENTARIO', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('a_gerente/reporte_excedente', 'DEVOLUCIONES', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('a_gerente/tabla_inv_farma', 'FARMABODEGA', 'class="button-link blue"');
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
