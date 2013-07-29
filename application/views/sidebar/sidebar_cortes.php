      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');	
"
<table>
<tr>";
if($nivel==3 && $tipo==0 || $nivel==5 || $nivel==23){
echo anchor('cortes/tabla_control_sucursal', 'SUCURSALES ASIGNADAS', 'class="button-link purple"');
echo "<strong>CAPTURA DE CORTES MANUAL</strong>";
echo anchor('cortes/tabla_control', 'CAPTURA_CORTES', 'class="button-link red"');
echo anchor('cortes/tabla_control_editar', 'EDITAR CORTES<br />', 'class="button-link pink"');
echo "<strong><br />CORTES PDV YUCIF POR DISCO</strong>";
echo anchor('cortes/subir_cortes', 'SUBIR CORTES', 'class="button-link green2"');
echo anchor('cortes/tabla_control_validado', 'EDITAR CORTES POR LINEA', 'class="button-link green"');
echo "<strong><br />REPORTES<br /></strong>";
echo anchor('cortes/tabla_control_faltante', 'FALTANTES DE CAJA<br />', 'class="button-link blue"');
echo anchor('cortes/tabla_control_cre', 'CREDITO EMPLEADOS<br />', 'class="button-link orange"');
echo anchor('cortes/tabla_control_poliza', 'CONTROL DE POLIZAS <br />', 'class="button-link red"');

}elseif($nivel==3 && $tipo==2){
echo "<strong><br />REPORTES<br /></strong>";
echo anchor('cortes/tabla_control_faltante1', 'FALTANTES DE CAJA X PLAZA<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('cortes/tabla_control_cre1', 'CREDITO EMPLEADOS X PLAZA<br />', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('cortes/tabla_control_poliza1', 'CONTROL DE POLIZAS <br />', 'class="button-link red"');
echo ('<br /><br />');

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
