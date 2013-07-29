      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
$suc = $this->session->userdata('suc');
$fec=date('Y-m-d');
$s="select DAYOFWEEK('$fec') as numero , a.suc,a.id_plaza as contador from catalogo.sucursal a where a.suc=$suc";
$q = $this->db->query($s);
$r=$q->row();
$numero=$r->numero;
$contador=$r->contador;
if($numero>0 and $contador==999 and $numero<=6){
echo anchor('encargado/movimiento', 'MOVIMIENTOS', 'class="button-link orange3"');
echo ('<br /><br />');
}
if($nivel==22){
echo anchor('encargado/movimiento_a', 'MOVIMIENTOS', 'class="button-link orange3"');
echo ('<br /><br />');
}


echo anchor('encargado/movimiento_his', 'MOVIMIENTOS CAPTURADOS ', 'class="button-link orange3"');
echo ('<br /><br />');

echo anchor('encargado/ventas_naturistas', 'NATURISTAS', 'class="button-link orange3"');
echo ('<br /><br />');
echo anchor('encargado/recetas_spt', 'MEDICOS', 'class="button-link orange3"');
echo ('<br /><br />');
	$this->load->view('sidebar/login');
?>
      </div>