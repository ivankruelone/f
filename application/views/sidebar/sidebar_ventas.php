      <div class="sidebar">

<?php
$is_logged_in = $this->session->userdata('is_logged_in');
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
if($is_logged_in == FALSE){

?>

<?php
	}elseif($is_logged_in == TRUE && $nivel == 9 || $nivel == 10 || $nivel == 14){
?>

<?php
	

echo anchor('ventas/fecha', 'REPORTE DE VENTAS', 'class="button-link purple"');
echo anchor('ventas/tabla_control_tar', 'TARJETAS DE CLIENTE PREFERENTE', 'class="button-link orange"');
echo anchor('ventas/fecha_tar', 'VTA DE PRODUCTOS CON DESCUENTO', 'class="button-link orange1"');
echo anchor('ventas/fecha_cli', 'VTA POR CLIENTE PREF.', 'class="button-link orange3"');
?>

<?php
	}elseif($is_logged_in == TRUE && $nivel == 15 && $tipo==2){
?>

<?php
	echo anchor('ventas/tabla_control_tar', 'TARJETAS CLIENTE PREFERENTE', 'class="button-link orange" style="position:relative; width:190px; height:20px;"');
    echo "<br/><br/>";
    echo anchor('ventas/calculo_comision', 'CALCULO DE PREMIOS', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
        echo "<br/><br/>";
    echo anchor('ventas/calcula_ventas_naturistas', 'CALCULO DE COMISIONES', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
        echo "<br/><br/>";
        echo anchor('ventas/busca_ventas_naturistas', 'BUSCA VENTA COMISIONES', 'class="button-link orange3" style="position:relative; width:190px; height:20px;"');
        echo "<br/><br/>";
    echo anchor('ventas/venta_medico', 'COMISIONES MEDICOS DUDOSA', 'class="button-link orange3" style="position:relative; width:190px; height:20px;"');
    echo anchor('ventas/calcula_ventas_naturistas_una', '.', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>

<?php
	}elseif($is_logged_in == TRUE && $nivel == 15 && $tipo==3){
?>

<?php
	echo anchor('ventas/tabla_control_tar', 'TARJETAS CLIENTE PREFERENTE', 'class="button-link orange" style="position:relative; width:190px; height:20px;"');
   
?>



<?php
	}
    
    
    $this->load->view('sidebar/login');
?>
      </div>
