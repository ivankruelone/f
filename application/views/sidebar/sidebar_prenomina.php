       <div class="sidebar">
<?php
    $nivel = $this->session->userdata('nivel');
    $tipo = $this->session->userdata('tipo');
?>
<?php

if($nivel==3 && $tipo==0 || $nivel==5){
echo anchor('prenomina/tabla_captura', 'CAPTURA DE PRENOMINA', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('prenomina/tabla_valida', 'VALIDACION DE PRENOMINA', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('prenomina/tabla_poliza', 'POLIZA DE PRENOMINA', 'class="button-link gray"');
echo ('<br /><br />');
}

if($nivel==3 && $tipo==2){
echo anchor('prenomina/tabla_poliza1', 'POLIZA DE PRENOMINA X PLAZA', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov1', 'REPORTE DE MOVIMIENTOS<br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_plantilla', 'PLANTILLA DE PERSONAL<br />', 'class="button-link red"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados3', 'BUSQUEDA DE PERSONAL<br />', 'class="button-link red"');
}
if($nivel==3 && $tipo==0){
$time=date('H');
if($time<22){
echo anchor('catalogo/tabla_empleados_captura/', 'CAPTURA DE MOVIMIENTOS <br />', 'class="button-link green"');
echo ('<br /><br />');
	
}
//echo anchor('recursos_humanos/tabla_empleados_pendientes_his', 'MOVIMIENTOS SIN RESPUESTA RH<br />', 'class="button-link green"');
//echo ('<br /><br />');    
echo anchor('catalogo/tabla_empleados_pendientes_his_val', 'MOVIMIENTOS VALIDADOS RH<br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov', 'REPORTE DE MOVIMIENTOS<br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados1', 'PLANTILLA DE PERSONAL<br />', 'class="button-link red"');
}
if($nivel==33  and $tipo > 1){
 echo "<strong>MOVIMIENTO DE CONTADOR FORANEO</strong>";
echo anchor('catalogo/tabla_empleados_pendientes_his', 'MOV.CONTADOR SIN RESPUESTA RH<br />', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_pendientes_his_val', 'MOVIMIENTOS VALIDADOS RH<br />', 'class="button-link gray"');
echo ('<br /><br />');
}
if($nivel==33  and $tipo <= 1){
if($tipo==1){
echo anchor('catalogo/tabla_empleados_captura/', 'CAPTURA DE MOVIMIENTOS <br />', 'class="button-link gray"');
echo ('<br /><br />');    
}
echo anchor('catalogo/tabla_empleados_pendientes_his', 'MOV.CONTADOR SIN RESPUESTA RH<br />', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov', 'REPORTE DE MOVIMIENTOS<br />', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov_ret', 'STATUS DE RETENCION', 'class="button-link gray"');
}
if($nivel==7){
echo anchor('catalogo/tabla_empleados_pendientes_his', 'MOVIMIENTOS SIN RESPUESTA NOMINAS<br />', 'class="button-link gray"');
echo ('<br /><br />');    
echo anchor('catalogo/tabla_empleados_pendientes_his_val', 'MOVIMIENTOS VALIDADOS NOMINAS<br />', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov', 'REPORTE DE MOVIMIENTOS<br />', 'class="button-link gray"');
}
$this->load->view('sidebar/login');
?>
      </div>
