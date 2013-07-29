      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
if($tipo==4){
echo anchor('recursos_humanos/tabla_empleados_captura_ab', 'ALTA DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_empleados_captura_ab_his', 'HISTORICO DE ALTA DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');

}elseif($tipo==2){

echo anchor('recursos_humanos/busqueda_empleado_gral', 'BUSCAR EMPLEADO', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');      
echo anchor('recursos_humanos/tabla_empleados_captura_ab', 'BAJA DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('recursos_humanos/tabla_empleados_captura_ab_his', 'HISTORICO DE BAJA DE EMPLEADOS<br />', 'class="button-link blue"');
echo ('<br /><br />');
}
	$this->load->view('sidebar/login');
?>
      </div>