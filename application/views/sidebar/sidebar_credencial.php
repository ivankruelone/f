      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');

if($nivel==33){
echo anchor('credencial/captura_datos_credencial', 'Empleados que ya estan <br />dados de alta en el 400', 'class="button-link purple"');
echo ('<br /><br />');
echo anchor('credencial/captura_datos_credencial1', 'Empleados que no estan <br />dados de alta en el 400', 'class="button-link purple"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
