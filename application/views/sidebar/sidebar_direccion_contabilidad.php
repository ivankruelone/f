      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
$id = $this->session->userdata('id_user');
if($nivel<>9){
echo ('CORTES<br />');
echo anchor('direccion/tabla_depositos', 'Depositos', 'class="button-link blue"');
echo "<br /><br />";
echo anchor('direccion/elige_fechas_recargas', 'Recargas', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('direccion/tabla_Ventas', 'Ventas', 'class="button-link blue"');
echo ('<br /><br />');
}else{
echo anchor('direccion/tabla_Ventas', 'Resultados', 'class="button-link blue"');
echo ('<br /><br />');
    
}

	$this->load->view('sidebar/login');
?>
      </div>