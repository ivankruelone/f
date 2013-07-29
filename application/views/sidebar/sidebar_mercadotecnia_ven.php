      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

echo anchor('mercadotecnia/tabla_ventas_cia', 'VENTAS PERFUMERIA POR CIA.<br />', 'class="button-link blue" target="blank"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_ventas', 'VENTAS POR PERFUMERIA SUC.<br />', 'class="button-link blue" target="blank"');
echo ('<br /><br />');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_ventas_total_cia', 'VENTAS TOTAL CIA.<br />', 'class="button-link blue" target="blank"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_ventas_total_cadena', 'VENTAS TOTAL CADENA.<br />', 'class="button-link blue" target="blank"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_ventas_total_lin', 'VENTAS TOTAL X LINEAS.<br />', 'class="button-link blue" target="blank"');
echo ('<br /><br />');
echo ('<br /><br />');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_utilidad_total_cia', 'UTILIDAD TOTAL CIA.<br />', 'class="button-link green" target="blank"');
echo ('<br /><br />');
//echo anchor('mercadotecnia/tabla_utilidad_total_cadena', 'UTILIDAD TOTAL CADENA.<br />', 'class="button-link green" target="blank"');
echo ('<br /><br />');
//echo anchor('mercadotecnia/tabla_utilidad_total_lin', 'UTILIDAD TOTAL X LINEAS.<br />', 'class="button-link green" target="blank"');
echo ('<br /><br />');

	$this->load->view('sidebar/login');
?>
      </div>