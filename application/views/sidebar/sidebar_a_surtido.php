      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==16){
echo anchor('a_surtido/tabla_control', 'CAPTURA DE PEDIDOS', 'class="button-link purple" style="position:relative; width:190px; height:20px;"'); 
echo anchor('a_surtido/tabla_control_his_mod', 'MODIFICAR FOLIOS CERRADOS', 'class="button-link red" style="position:relative; width:190px; height:20px;"');
}

echo "<br/>";
if($nivel==30){
echo "<br/>";
echo anchor('captura_pedido1/historico_de_pedidos_esp', 'HISTORICO DE PEDIDOS ESPECIALES', 'class="button-link green"');
}
echo "<br/>";
if($nivel==12 || $nivel==16 || $nivel== 30 || $nivel== 34 || $nivel== 24){
echo "<br/><strong>LISTADO DE PEDIDOS CERRADOS</strong><br/><br/>";
echo anchor('a_surtido/tabla_control_his', 'FOLIOS CERRADOS', 'class="button-link pink" style="position:relative; width:190px; height:20px;"');
echo anchor('a_surtido/tabla_control_his1', 'FOLIOS CERRADOS ESPECIALES', 'class="button-link pink" style="position:relative; width:190px; height:20px;"');
echo "<br/>";
echo "<br/><strong>REPORTES DE PEDIDOS CERRADOS</strong><br/><br/>";
echo anchor('a_surtido/reporte_diario', 'REPORTES DE CAPTURA PDF', 'class="button-link red" style="position:relative; width:190px; height:20px;"');


}
echo "<br/>";
if($nivel==12){
echo "<br/><strong>REPORTE DE PEDIDOS ABIERTOS</strong><br/><br/>";
echo anchor('a_surtido/folios_abiertos', 'REPORTE DE FOLIOS PENDIENTES <br />POR CERRAR PDF', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
}
echo "<br/>";
if($nivel==12){
echo "<br/><strong>REPORTE DE SURTIDO X CLAVE</strong><br/><br/>";
echo anchor('a_surtido/reporte_diario_xclave', 'REPORTE SURTIDO X CLAVE', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo "<br/><strong>CAPTURA</strong><br/><br/>";
echo anchor('a_surtido/captura_sob_fal', 'SOBRANTE/FALTANTE FORMULADO', 'class="button-link yellow" style="position:relative; width:190px; height:20px;"');
echo "<br/><br/>";
echo anchor('a_surtido/tabla_sob_fal', 'FORMULADOS', 'class="button-link yellow" style="position:relative; width:190px; height:20px;"');
echo "<br/><br/><br/><br/>";
echo anchor('a_surtido/captura_sob_fal_esp', 'SOBRANTE/FALTANTE ESPECIALES', 'class="button-link yellow" style="position:relative; width:190px; height:20px;"');
echo "<br/><br/>";
echo anchor('a_surtido/tabla_sob_fal_esp', 'ESPECIALES', 'class="button-link yellow" style="position:relative; width:190px; height:20px;"');
}
?>
<?php
    echo "<br/>";
	$this->load->view('sidebar/login');
?>
      </div>