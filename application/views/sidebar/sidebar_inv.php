      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel == 10 || $nivel == 11){
    echo anchor('inv/inv_pendientes', 'PENDIENTES', 'class="button-link purple" style="position:relative; width:190px; height:16px;"');
    echo anchor('inv/inv_findemes', 'INVENTARIO FIN DE MES', 'class="button-link red" style="position:relative; width:190px; height:16px;"');
    echo anchor('inv/inv_pendientes_findemes', 'PENDIENTES FIN DE MES', 'class="button-link purple" style="position:relative; width:190px; height:16px;"');
    echo anchor('inv/inv_ftpback', 'INVENTARIO de Back Office', 'class="button-link yellow" style="position:relative; width:190px; height:16px;"');
    echo '<br />';
    echo anchor('inv/con_clave_generica', 'CON CLAVE GENERICA', 'class="button-link purple" style="position:relative; width:190px; height:16px;"');
    echo anchor('inv/sin_clave_generica', 'SIN CLAVE GENERICA', 'class="button-link purple" style="position:relative; width:190px; height:16px;"');
}
echo "<br/><br/>";
if($nivel==10){
    echo anchor('a_inv/index', 'Inventario CEDIS', 'class="button-link green" style="position:relative; width:190px; height:16px;"');


}
?>
<?php
	$this->load->view('sidebar/login');
?>

<?php
	
if($nivel == 2 ){
  echo anchor('captura_inventario', 'CAPTURA DE INVENTARIO', 'class="button-link green" style="position:relative; width:190px; height:16px;"');  
}
?>
      </div>
