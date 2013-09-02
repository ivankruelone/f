      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
$suc = $this->session->userdata('suc');
if($nivel==4 || $nivel==10){
echo anchor('catalogo/catalogo_usuarios', 'CATALOGO DE USUARIOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo/catalogo_polizas', 'CATALOGO DE POLIZAS', 'class="button-link blue"');
echo anchor('catalogo/catalogo_cuentas', 'CATALOGO DE CUENTAS <br />', 'class="button-link red"');
echo anchor('catalogo/catalogo_plazas', 'CATALOGO DE PLAZAS <br />', 'class="button-link gray"');
echo anchor('catalogo/catalogo_beneficiario', 'CATALOGO DE BENEFICIARIOS <br />', 'class="button-link pink"');
}
if($nivel==31 and $tipo==1 ){
echo anchor('catalogo/tabla_rentas_agrega', 'AGREGA RENTAS <br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_rentas_vista_general', 'REPORTE GENERAL <br />', 'class="button-link gray"');    
}
if($nivel==31 and $tipo==1 || $nivel==32 || $nivel==3){
echo anchor('catalogo/tabla_rentas_busca', 'BUSCA ARRENDADORES <br />', 'class="button-link pink"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_rentas_his', 'HISTORICO ARRENDADORES <br />', 'class="button-link gray"');
}
if($nivel==31 and $tipo==2){
    //////ana maria ramos de juridico
echo anchor('catalogo/tabla_rentas_his', 'HISTORICO ARRENDADORES <br />', 'class="button-link gray"');
echo ('<br /><br />');
echo anchor('catalogo/tabla_empleados_mov_ret', 'STATUS DE RETENCION', 'class="button-link gray"');    
}
if($nivel==15 and $tipo==2){
echo  anchor('catalogo_ger/tabla_ger', 'GERENTE REGIONAL', 'class="button-link pink" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_sup', 'SUPERVISORES', 'class="button-link orange" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/plantilla_sup', 'PLANTILLA POR SUPERVISOR', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/busqueda_emp', 'BUSCAR EMPLEADO', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_natur', 'PRODUCTOS NATURISTAS', 'class="button-link orange" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener', 'CATALOGOS DE GENERICOS', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_patente', 'CATALOGOS DE PATENTE ALM', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
}
if($nivel==14){
echo anchor('catalogo_ger/tabla_farmabodega', 'CATALOGO DE FARMABODEGA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');    
echo anchor('catalogo_ger/tabla_cambios_precios', 'CAMBIOS DE PRECIOS', 'class="button-link green"');
echo ('<br /><br />');
echo  anchor('catalogo_ger/tabla_suc_asignadas', 'SUCURSALES  ', 'class="button-link pink"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_natur', 'PRODUCTOS NATURISTAS', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener', 'CATALOGOS DE GENERICOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_patente', 'CATALOGOS DE PATENTE ALM', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_desco', 'CAT. DE PROD.DESCONTINUADOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_paquete', 'CAT. DE PROD. POR PAQUETES ', 'class="button-link green"');
}
if($nivel==2){
if($suc>1600 and $suc<=1603){
echo anchor('catalogo_ger/tabla_farmabodega', 'CATALOGO DE FARMABODEGA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');    
}
echo anchor('catalogo_ger/tabla_cambios_precios', 'CAMBIOS DE PRECIOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_desco', 'CAT. DE PROD.DESCONTINUADOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_paquete', 'CAT. DE PROD. POR PAQUETES ', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener', 'CATALOGOS DE GENERICOS', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/cat_naturistas', 'PRODUCTOS NATURISTAS', 'class="button-link green"');
echo ('<br /><br />');
}
if($nivel == 21 ){
echo anchor('catalogo_ger/tabla_farmabodega', 'CAT.FARMABODEGA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');    
echo anchor('catalogo_ger/tabla_cambios_precios', 'CAMBIOS DE PRECIOS', 'class="button-link green"');
echo ('<br /><br />');
echo  anchor('catalogo_ger/tabla_sup_asignadas_ger', 'SUPERVISOR  ', 'class="button-link pink"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_natur', 'PRODUCTOS NATURISTAS', 'class="button-link orange"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener', 'CATALOGOS DE GENERICOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener_patente', 'CATALOGOS DE PATENTE ALM', 'class="button-link green"');
}
if( $nivel==9){
echo  anchor('catalogo_ger/tabla_sup_asignadas_ger_ger', 'GERENTES  ', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_farmabodega', 'FARMABODEGA', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');    
echo anchor('catalogo_ger/tabla_cambios_precios', 'CAMBIOS DE PRECIOS', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_natur', 'NATURISTAS', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_gener', 'GENERICOS Y DDR', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
//echo anchor('catalogo_ger/tabla_gener_patente', 'CATALOGOS DE PATENTE ALM', 'class="button-link green"');
}
if($nivel==53){
echo anchor('catalogo_ger/tabla_genericos', 'GENERICOS', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');   
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>