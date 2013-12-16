<?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
            $ip_address = $this->session->userdata('ip_address');
            $nivel = $this->session->userdata('nivel');
            $tipo = $this->session->userdata('tipo');
            $suc = $this->session->userdata('username');
            
            if($nivel == null){

?>


      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "welcome") echo " class=\"selected\"";?>><?php echo anchor('welcome/index/0', 'Proyectos');?></li>
          <?php
            if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){


            }else{
          ?>
          <li<?php if(isset($selector) && $selector == "historia") echo " class=\"selected\"";?>><?php echo anchor('historia/index', 'Historia');?></li>
          <?php
	       }
          ?>
          <li<?php if(isset($selector) && $selector == "empresa") echo " class=\"selected\"";?>><?php echo anchor('empresa2/index', 'Empresa');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>

        </ul>
      </div>

<?php
	}elseif($nivel == 1){
	   
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "welcome") echo " class=\"selected\"";?>><?php echo anchor('welcome/index/0', 'Proyectos');?></li>

          <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
          <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
          
        </ul>
      </div>


<?php
	}elseif($nivel == 2){
?>
      <div id="menubar">
        <ul id="menu">
<?php
if($suc==102 ||$suc==103 ||$suc==105 ||$suc==141 ||$suc==108
||$suc==109 ||$suc==124 ||$suc==115 ||$suc==107 ||$suc==129 ||$suc==202 ||$suc==112){
?>        
        <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/indexa', 'Pedidos Especiales');?></li>
<?php
	}
?>        
          <li<?php if(isset($selector) && $selector == "encargado") echo " class=\"selected\"";?>><?php echo anchor('encargado/indexm', 'MOVIMIENTOS');?></li>
         <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/pedidos_sucursal', 'Pedidos');?></li>
          <li<?php if(isset($selector) && $selector == "inventario") echo " class=\"selected\"";?>><?php echo anchor('inv/inventario_sucursal', 'Inventario');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
          <li<?php if(isset($selector) && $selector == "welcome") echo " class=\"selected\"";?>><?php echo anchor('welcome/index/0', 'Proyectos');?></li>
                  
        </ul>
      </div>

<?php
	}elseif($nivel == 3 ){
?>
      <div id="menubar">
        <ul id="menu">
        
          
          <li<?php if(isset($selector) && $selector == "prenomina") echo " class=\"selected\"";?>><?php echo anchor('prenomina/index', 'Prenomina');?></li>
          <li<?php if(isset($selector) && $selector == "cheques") echo " class=\"selected\"";?>><?php echo anchor('cheques/index', 'Cheques');?></li>
          <li<?php if(isset($selector) && $selector == "cortes") echo " class=\"selected\"";?>><?php echo anchor('cortes', 'Cortes');?></li>
          <li<?php if(isset($selector) && $selector == "tutoriales") echo " class=\"selected\"";?>><?php echo anchor('tuto_nominas/index', 'Tutoriales');?></li>
          <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
          <li<?php if(isset($selector) && $selector == "supervisor") echo " class=\"selected\"";?>><?php echo anchor('supervisor/indexm', 'supervisor');?></li>
          <li<?php if(isset($selector) && $selector == "credencial") echo " class=\"selected\"";?>><?php echo anchor('credencial/captura_datos_credencial', 'Credencial');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 4){
?>
      <div id="menubar">
        <ul id="menu">
          
          <li<?php if(isset($selector) && $selector == "prenomina") echo " class=\"selected\"";?>><?php echo anchor('prenomina/index', 'Prenomina');?></li>
          <li<?php if(isset($selector) && $selector == "cheques") echo " class=\"selected\"";?>><?php echo anchor('cheques/tabla_control', 'Cheques');?></li>
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "cheques") echo " class=\"selected\"";?>><?php echo anchor('cheques', 'Cheques');?></li>
        </ul>
      </div>
<?php
	}elseif($nivel == 3 || $nivel == 5 || $nivel == 23){
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "cortes") echo " class=\"selected\"";?>><?php echo anchor('cortes', 'Cortes');?></li>
           <li<?php if(isset($selector) && $selector == "plantilla") echo " class=\"selected\"";?>><?php echo anchor('cortes/indexp', 'Pantilla');?></li>
           <li<?php if(isset($selector) && $selector == "plantilla") echo " class=\"selected\"";?>><?php echo anchor('cortes/indexr', 'REPORTES');?></li>
          <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 7 && $tipo==0){
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "envio") echo " class=\"selected\"";?>><?php echo anchor('envio', 'envio');?></li>
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_empleados', 'MOVIMIENTOS');?></li>
          <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 7 && $tipo==1){
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "envio") echo " class=\"selected\"";?>><?php echo anchor('envio', 'REPORTE');?></li>
            </ul>
      </div>

<?php
	}elseif($nivel == 6){
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "facturas_jur") echo " class=\"selected\"";?>><?php echo anchor('facturas_juridico', 'Facturas');?></li>
          <li<?php if(isset($selector) && $selector == "catalogos_jur") echo " class=\"selected\"";?>><?php echo anchor('facturas_juridico/catalogos', 'Catalogos');?></li>
        </ul>
      </div>
<?php
	}elseif($nivel == 8){
?>
      <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "audita") echo " class=\"selected\"";?>><?php echo anchor('audita/cortes', 'CORTES');?></li>
        </ul>
      </div>



<?php
	}elseif($nivel == 9){
            
?>
 <div id="menubar">
 <ul id="menu">
 <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
<li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
<li<?php if(isset($selector) && $selector == "nacional_ped") echo " class=\"selected\"";?>><?php echo anchor('nacional/index_estadistica', 'Estadisticas');?></li>
<li<?php if(isset($selector) && $selector == "nacional_ven") echo " class=\"selected\"";?>><?php echo anchor('nacional/ventas', 'VENTAS');?></li>
<li<?php if(isset($selector) && $selector == "nacional_mov") echo " class=\"selected\"";?>><?php echo anchor('nacional/indexm', 'MOVIMIENTOS');?></li>
<li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>          
<li<?php if(isset($selector) && $selector == "campa") echo " class=\"selected\"";?>><?php echo anchor('direccion/tabla_ventas', 'RESULTADOS');?></li>
<li<?php if(isset($selector) && $selector == "bitacora") echo " class=\"selected\"";?>><?php echo anchor('bitacora/index', 'Bitacora');?></li>
          
 </ul>
</div>


<?php
	}elseif($nivel == 10){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Direc');?></li>
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
          <li<?php if(isset($selector) && $selector == "ventas") echo " class=\"selected\"";?>><?php echo anchor('ventas/index', 'Ventas');?></li>
          <li<?php if(isset($selector) && $selector == "inv") echo " class=\"selected\"";?>><?php echo anchor('inv/index', 'Inv');?></li>
          <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('reportes/index', 'Rep');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 11 && $tipo == 1){
?>

    <div id="menubar">
        <ul id="menu">
        
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
          <li<?php if(isset($selector) && $selector == "inv") echo " class=\"selected\"";?>><?php echo anchor('inv/index', 'Inv');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>
      
<?php
	}elseif($nivel == 11 && $tipo == 2){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
          <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
          <li<?php if(isset($selector) && $selector == "formato") echo " class=\"selected\"";?>><?php echo anchor('sucursales/formato_sucur', 'Formato');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 12){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/index', 'Captura');?></li>
          <li<?php if(isset($selector) && $selector == "a_traspaso") echo " class=\"selected\"";?>><?php echo anchor('a_traspaso/index', 'Traspaso');?></li>
          <li<?php if(isset($selector) && $selector == "a_devolucion") echo " class=\"selected\"";?>><?php echo anchor('a_devolucion/index', 'Devolucion');?></li>
          <li<?php if(isset($selector) && $selector == "a_compra") echo " class=\"selected\"";?>><?php echo anchor('a_compra/index', 'Compra');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
          <li<?php if(isset($selector) && $selector == "r_ventas") echo " class=\"selected\"";?>><?php echo anchor('r_ventas/index', 'Ventas');?></li>
          <li<?php if(isset($selector) && $selector == "vehiculo") echo " class=\"selected\"";?>><?php echo anchor('equipos/nuevo_vehiculo', 'Vehiculos');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 13){

?>

    <div id="menubar">
        <ul id="menu">
        
          <li<?php if(isset($selector) && $selector == "backcat") echo " class=\"selected\"";?>><?php echo anchor('backoffice/index', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 14){
?>

<div id="menubar">
 <ul id="menu">
 <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
<li<?php if(isset($selector) && $selector == "supervisor_ped") echo " class=\"selected\"";?>><?php echo anchor('supervisor/pedidos', 'PEDIDOS');?></li>          
<li<?php if(isset($selector) && $selector == "supervisor_ven") echo " class=\"selected\"";?>><?php echo anchor('supervisor/ventas', 'VENTAS');?></li>
<li<?php if(isset($selector) && $selector == "supervisor_mov") echo " class=\"selected\"";?>><?php echo anchor('supervisor/indexm', 'MOVIMIENTOS');?></li>
<li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>          
<li<?php if(isset($selector) && $selector == "bitacora") echo " class=\"selected\"";?>><?php echo anchor('bitacora/index', 'Bitacora');?></li>          
 </ul>
</div>

<?php
	}elseif($nivel == 15){
?>

<div id="menubar">
 <ul id="menu">
 <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Direc');?></li>
 <li<?php if(isset($selector) && $selector == "mercadotecniav") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexv', 'VENTAS DIRECCION');?></li>
  <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
  <li<?php if(isset($selector) && $selector == "ventas") echo " class=\"selected\"";?>><?php echo anchor('ventas/index', 'Ventas');?></li>
  <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/indexa', 'Pedidos Especiales');?></li>
  <li<?php if(isset($selector) && $selector == "inv") echo " class=\"selected\"";?>><?php echo anchor('inv/inv_x_clave', 'Inv');?></li>
 </ul>
</div>

<?php
	}elseif($nivel == 16){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/index', 'Captura');?></li>
          <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/salida_codigo', 'Salida x Codigo');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
          <li<?php if(isset($selector) && $selector == "captura_pedido1") echo " class=\"selected\"";?>><?php echo anchor('captura_pedido1', 'Captura de Pedido');?></li>
          <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('reportes', 'Reportes');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 17){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "a_compra") echo " class=\"selected\"";?>><?php echo anchor('a_compra/index', 'Compra');?></li>
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_cedis', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 18){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "a_traspaso") echo " class=\"selected\"";?>><?php echo anchor('a_traspaso/index', 'Traspaso');?></li>
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_cedis', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 19){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "a_devolucion") echo " class=\"selected\"";?>><?php echo anchor('a_devolucion/index', 'Devolucion');?></li>
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_cedis', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
        </ul>
      </div>


<?php
	}elseif($nivel == 20 && $tipo == 1){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_his_busqueda', 'FOLIOS CERRADOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
        <li<?php if(isset($selector) && $selector == "trans") echo " class=\"selected\"";?>><?php echo anchor('trans/index', 'Transporte');?></li> 
        </ul>
      </div>
      
<?php
	}elseif($nivel == 20 && $tipo == 2){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
          <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_his_busqueda', 'FOLIOS CERRADOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li> 
        </ul>
      </div>

<?php
	}elseif($nivel == 21){
?>

<div id="menubar">
 <ul id="menu">
<li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
<li<?php if(isset($selector) && $selector == "gerente_ped") echo " class=\"selected\"";?>><?php echo anchor('gerente/pedidos_ger', 'PEDIDOS');?></li>          
<li<?php if(isset($selector) && $selector == "gerente_ven") echo " class=\"selected\"";?>><?php echo anchor('gerente/ventas', 'VENTAS');?></li>
<li<?php if(isset($selector) && $selector == "gerente_mov") echo " class=\"selected\"";?>><?php echo anchor('gerente/indexm', 'MOVIMIENTOS');?></li>
<li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>          
<li<?php if(isset($selector) && $selector == "bitacora") echo " class=\"selected\"";?>><?php echo anchor('bitacora/index', 'Bitacora');?></li>          
 </ul>
</div>

<?php
	}elseif($nivel == 22){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "procesos") echo " class=\"selected\"";?>><?php echo anchor('procesos/index', 'Procesos');?></li>
        <li<?php if(isset($selector) && $selector == "seguropop") echo " class=\"selected\"";?>><?php echo anchor('seguropop/index', 'Seguro Pop');?></li>
        <li<?php if(isset($selector) && $selector == "catalogos") echo " class=\"selected\"";?>><?php echo anchor('procesos/index1', 'Catalogos');?></li>
        <li<?php if(isset($selector) && $selector == "procesos_revisa") echo " class=\"selected\"";?>><?php echo anchor('procesos/index_rev', 'Revisa');?></li>
        
        <li<?php if(isset($selector) && $selector == "mercadotecniav") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexv', 'VENTAS DIRECCION');?></li>
        <li<?php if(isset($selector) && $selector == "encargado") echo " class=\"selected\"";?>><?php echo anchor('encargado/indexm', 'MOVIMIENTOS');?></li>
        </ul>
      </div>


<?php
	}elseif($nivel == 24){
?>
    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
        <li<?php if(isset($selector) && $selector == "mueble") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_mue', 'UBICACION');?></li>  
        <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_his_busqueda', 'FOLIOS CERRADOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/surtidores', 'SURTIDORES');?></li>
        <li<?php if(isset($selector) && $selector == "a_rutas") echo " class=\"selected\"";?>><?php echo anchor('a_inv/rutas', 'RUTAS');?></li>
        <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('reportes', 'Reportes');?></li>
        </ul>
      </div>

<?php
	}elseif($nivel == 25){
?>
    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        <li<?php if(isset($selector) && $selector == "equipos") echo " class=\"selected\"";?>><?php echo anchor('equipos/index', 'Equipos');?></li>
        <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
        </ul>
      </div>

<?php
    }elseif($nivel == 26){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "mercadotecniac") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexc', 'Catalogo');?></li>
        </ul>
      </div>


<?php
	}elseif($nivel == 30){
?>
    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>  
        <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_his_busqueda', 'FOLIOS CERRADOS');?></li>
        <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/empacadores', 'EMPACADORES');?></li>
        <li<?php if(isset($selector) && $selector == "a_rutas") echo " class=\"selected\"";?>><?php echo anchor('a_inv/rutas', 'RUTAS');?></li>
        </ul>
      </div>


<?php
	}elseif($nivel == 31 || $nivel == 32){

?>
    <div id="menubar">
        <ul id="menu">
<?php  if($tipo ==1){?>        
        <li<?php if(isset($selector) && $selector == "juridico") echo " class=\"selected\"";?>><?php echo anchor('juridico/tabla_rentas', 'CATALOGO');?></li>
       <?php }  ?>
        <li<?php if(isset($selector) && $selector == "juridico_r") echo " class=\"selected\"";?>><?php echo anchor('juridico/index_ger', 'MOVIMIENTOS');?></li>
        </ul>
      </div>


<?php
    }elseif($nivel == 33){
    	//<li<?php if(isset($selector) && $selector == "supervisor") echo " class=\"selected\"";<?php echo anchor('supervisor/indexm', 'supervisor');
?>

    <div id="menubar">
        <ul id="menu">
        
  <?php  if($tipo == 0){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos1") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/reportes_depto', 'CHECADOR');?></li>
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_empleados', 'CATALOGO');?></li>
        
 <?php }
 if($tipo == 1){?>
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/tabla_empleados', 'RETENCION');?></li>
        <li<?php if(isset($selector) && $selector == "recursos_humanos1") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/index', 'Supervisor');?></li>
        <li<?php if(isset($selector) && $selector == "recursos_humanos2") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/tabla_pendiente_cambio', 'Pendientes');?></li>
        <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
        <li<?php if(isset($selector) && $selector == "procesos") echo " class=\"selected\"";?>><?php echo anchor('procesos/index', 'Procesos');?></li>
 <?php }
 if($tipo == 4){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos3") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/indexab', 'Altas');?></li>
        <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
        <li<?php if(isset($selector) && $selector == "credencial") echo " class=\"selected\"";?>><?php echo anchor('credencial/index', 'Credencial');?></li>
 <?php }
  
 if($tipo == 2){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos3") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/indexab', 'BAJAS');?></li>
        <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
        
 <?php }
  if($tipo == 3 || $tipo == 5){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/indexc', 'MOVIMIENTOS');?></li>
        <li<?php if(isset($selector) && $selector == "recursos_humanos5") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/index_nom', 'NOMINA');?></li>
        <li<?php if(isset($selector) && $selector == "recursos_humanos5") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/index_vac', 'Vacaciones');?></li>
        <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
 <?php }if($tipo == 6){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/indexc', 'INCAPACIDAD');?></li>
        <li<?php if(isset($selector) && $selector == "recursos_humanos4") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/indexf', 'FALTAS');?></li>
        <li<?php if(isset($selector) && $selector == "calendario") echo " class=\"selected\"";?>><?php echo anchor('calendario/index', 'Calendario');?></li>
  <?php }if($tipo == 7){?>
        <li<?php if(isset($selector) && $selector == "recursos_humanos1") echo " class=\"selected\"";?>><?php echo anchor('recursos_humanos/index', 'Supervisor');?></li>
         <?php }?>         
        </ul>
      </div>
      
<?php
	}elseif($nivel == 34){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "pedidos") echo " class=\"selected\"";?>><?php echo anchor('pedido/pedido', 'PEDIDOS');?></li>
          <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_control_his_busqueda', 'FOLIOS CERRADOS');?></li>
          <li<?php if(isset($selector) && $selector == "a_inv") echo " class=\"selected\"";?>><?php echo anchor('a_inv/index', 'Inventario');?></li>
          
        </ul>
      </div>

<?php
    }elseif($nivel == 35){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "seguropop") echo " class=\"selected\"";?>><?php echo anchor('seguropop/index', 'Seguro Pop');?></li>
        </ul>
      </div>

<?php
    }elseif($nivel == 36){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "mercadotecniac") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexc', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "mercadotecnian") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexn', 'Notas');?></li>
          <li<?php if(isset($selector) && $selector == "mercadotecniad") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexd', 'Desplazamiento');?></li>
          <li<?php if(isset($selector) && $selector == "mercadotecniap") echo " class=\"selected\"";?>><?php echo anchor('mercadotecnia/indexp', 'Pedidos');?></li>
          <li<?php if(isset($selector) && $selector == "licitacion") echo " class=\"selected\"";?>><?php echo anchor('licitacion/indexc', 'Licita');?></li>
        </ul>
      </div>

<?php
    }elseif($nivel == 37){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo_externo/catalogo_saba', 'Catalogo');?></li>
          <li<?php if(isset($selector) && $selector == "subida") echo " class=\"selected\"";?>><?php echo anchor('catalogo_externo/subida_saba', 'Subida');?></li>
        </ul>
      </div>
<?php //LO QUE SE VA BORRANDO DE COMPRAS
    }elseif($nivel == 99999){
    ?>    
   <li<?php if(isset($selector) && $selector == "compra") echo " class=\"selected\"";?>></li><?php echo anchor('compras/index_com', 'COMPRA');?></li>
   <li<?php if(isset($selector) && $selector == "faltante") echo " class=\"selected\"";?>></li><?php echo anchor('compras/index_fal', 'FANTANTES');?></li>
     

<?php
    }elseif($nivel == 38){
        
?>
                
    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('compras/index', 'CATALOGO');?></li>
          <li<?php if(isset($selector) && $selector == "orden") echo " class=\"selected\"";?>><?php echo anchor('compras/index_ord', 'ORDEN DE COMPRA');?></li>
          <li<?php if(isset($selector) && $selector == "orden") echo " class=\"selected\"";?>><?php echo anchor('compras/index_d', 'Desplazamientos');?></li>
          <li<?php if(isset($selector) && $selector == "orden") echo " class=\"selected\"";?>><?php echo anchor('compras/tabla_ventas', 'VENTAS');?></li>
          <li<?php if(isset($selector) && $selector == "orden") echo " class=\"selected\"";?>><?php echo anchor('compras/index_inv', 'Inv');?></li>
          <li<?php if(isset($selector) && $selector == "licita") echo " class=\"selected\"";?>><?php echo anchor('compra_lic/index', 'Licita');?></li>
         
         </ul>
      </div>
      
<?php
	}elseif($nivel == 39){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
        <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
        <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>      

<?php
}elseif($nivel == 41){
?>

    <div id="menubar">
        <ul id="menu">
                 <li<?php if(isset($selector) && $selector == "gcomercial") echo " class=\"selected\"";?>><?php echo anchor('direccion/index_gcomercial', 'G.COMERCIAL');?></li>
                 <li<?php if(isset($selector) && $selector == "compras") echo " class=\"selected\"";?>><?php echo anchor('direccion/index_compras', 'COMPRAS');?></li>
                 <li<?php if(isset($selector) && $selector == "rh") echo " class=\"selected\"";?>><?php echo anchor('direccion/index_rh', 'RH');?></li>
                 <li<?php if(isset($selector) && $selector == "contabilidad") echo " class=\"selected\"";?>><?php echo anchor('direccion/index_con', 'CONTABILIDAD');?></li>
        </ul>
      </div>

<?php
    }elseif($nivel == 42){
?>

    <div id="menubar">
        <ul id="menu">
                 <li<?php if(isset($selector) && $selector == "campa") echo " class=\"selected\"";?>><?php echo anchor('direccion/index_gcomercial', 'CAMPA&Ntilde;A');?></li>
                 <li<?php if(isset($selector) && $selector == "nacional_ped") echo " class=\"selected\"";?>><?php echo anchor('nacional/pedidos_ger', 'PEDIDOS');?></li>
        </ul>
      </div>

<?php
    }elseif($nivel == 52){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('cat_generico/index', 'Catalogo Metro, SP y Generico');?></li>
        </ul>
      </div>      

<?php
}elseif($nivel == 53){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('catalogo/index', 'Catalogo');?></li>
        <li<?php if(isset($selector) && $selector == "directorio") echo " class=\"selected\"";?>><?php echo anchor('directorio/index', 'Directorio');?></li>
        <li<?php if(isset($selector) && $selector == "sucursales") echo " class=\"selected\"";?>><?php echo anchor('sucursales/index', 'Sucursales');?></li>
        <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
        </ul>
      </div>      
      
<?php
    }elseif($nivel == 55){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('a_gerente/index', 'COMPRA');?></li>
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('a_gerente/index_inv', 'Inv');?></li>
        <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('a_gerente/reporte_puntualidad', 'Reportes');?></li>
      </div>      
      
<?php
    }elseif($nivel == 56){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('medicos/index', 'MEDICOS');?></li>
        
      </div>      
      
<?php
    }elseif($nivel == 57){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "catalogo") echo " class=\"selected\"";?>><?php echo anchor('compras/index_lote', 'MEDICAMENTO POR LOTE');?></li>
        
      </div>      
      
<?php
    }elseif($nivel == 58){
?>

    <div id="menubar">
        <ul id="menu">
        <li<?php if(isset($selector) && $selector == "a_rutas") echo " class=\"selected\"";?>><?php echo anchor('a_inv/rutas', 'RUTAS');?></li>
        <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('reportes/index', 'Rep');?></li>
      </div>  
      
<?php
    }elseif($nivel == 98){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "reportes") echo " class=\"selected\"";?>><?php echo anchor('sistemas', 'REPORTES');?></li>
    </ul>
      </div>
      
      <?php
    }elseif($nivel == 99){
?>

    <div id="menubar">
        <ul id="menu">
          <li<?php if(isset($selector) && $selector == "contacto") echo " class=\"selected\"";?>><?php echo anchor('contacto/index', 'Contacto');?></li>
          <li<?php if(isset($selector) && $selector == "a_surtido") echo " class=\"selected\"";?>><?php echo anchor('a_surtido/tabla_facturas', 'FACTURAS');?></li>
    </ul>
      </div>

<?php
    }
 ?>