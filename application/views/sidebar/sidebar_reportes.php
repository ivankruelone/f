      <div class="sidebar">
<?php
	$this->load->view('sidebar/login');
?>
<?php
$nivel = $this->session->userdata('nivel');

if($nivel==10){
	echo anchor('reportes/sucur_cia', 'R Sucur_compa&ntilde;ia', 'class="button-link purple", style="position:relative; width:190px; height:20px;"');
}elseif($nivel==58){
    echo anchor('reportes/rep_rutas', 'Rep x Ruta', 'class="button-link purple", style="position:relative; width:140px; height:20px;"');
}elseif($nivel==16){
    echo anchor('reportes/rep_esp', 'Rep. Especiales y Metro ', 'class="button-link purple", style="position:relative; width:140px; height:20px;"');
}elseif($nivel==24){
    echo anchor('reportes/rep_pza', 'Concentrado pzas ', 'class="button-link purple", style="position:relative; width:140px; height:20px;"');
}
?>


      </div>
