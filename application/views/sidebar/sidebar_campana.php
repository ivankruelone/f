      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
"
<table>
<tr>";
if($nivel==38){    
echo anchor('compras/tabla_cat_campa', 'Campa&ntilde;a', 'class="button-link purple"');
}
if($nivel==5){
    echo "<strong><br />SOLO CORTES<br /></strong>";
echo anchor('cortes/tabla_control_faltante_recarga', 'FALTANTES VARIOS<br />', 'class="button-link gray"'); 
echo anchor('cortes/tabla_control_validado_corte', 'EDITAR CORTES TRABAJADOS<br /> ', 'class="button-link orange"');
echo anchor('cortes/tabla_envio_cortes', 'ENVIO CORTES A AS/400 <br />', 'class="button-link orange2"');    
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
