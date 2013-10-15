      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
//echo anchor('nacional/ventas', 'REPORTE DE VENTAS', 'class="button-link orange3"');
//echo ('<br /><br />');
echo anchor('direccion/tabla_cont_venta', 'VENTA CONCENTRADA', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo "<br /><br />";
echo anchor('direccion/tabla_depositos', 'DEPOSITOS', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo "<br /><br />";
echo anchor('nacional/cortes', 'CORTES DE CAJA', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/cortes_comanche', 'RECARGA TELEFONICA', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/tarjetas', 'TARJ.DE DESCUENTO', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/natur', 'NATURISTAS', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');
echo ('<br /><br />');
echo anchor('nacional/tabla_comision', 'COMISIONES', 'class="button-link blue" style="position:relative; width:140px; height:20px;"');

	$this->load->view('sidebar/login');
?>
      </div>