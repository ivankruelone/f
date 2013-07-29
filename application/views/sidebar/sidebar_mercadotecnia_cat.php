      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');

if($nivel==36 || $nivel==26){
echo anchor('mercadotecnia/tabla_catalogo', 'Catalogo de Ofertas<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_catalogo_act', 'Catalogo de Ofertas Act.<br />', 'class="button-link blue"');
echo ('<br /><br />');
}
if($nivel==36){
echo anchor('mercadotecnia/tabla_catalogo_lab', 'Catalogo de laboratorios<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_usuarios_lab', 'Usuarios de laboratorios<br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('mercadotecnia/tabla_cat_as400', 'Actualizar web<br />', 'class="button-link blue"');
echo ('<br /><br />');
}
	$this->load->view('sidebar/login');
?>
      </div>