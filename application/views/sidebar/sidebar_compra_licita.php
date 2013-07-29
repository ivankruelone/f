      <div class="sidebar">
<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
echo anchor('licitacion/tabla_cat_licita/'.'PA', 'Catalogo', 'class="button-link green"');
//echo anchor('licitacion/tabla_cat_licita/'.'1', 'Catalogo Medicamento', 'class="button-link green"');
//echo anchor('licitacion/tabla_cat_licita/'.'5', 'Catalogo Mat.Curacion', 'class="button-link green"');
echo ('<br /><br />');




	$this->load->view('sidebar/login');
?>
      </div>