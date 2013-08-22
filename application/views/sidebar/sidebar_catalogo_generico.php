      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
if($nivel==52){
echo anchor('cat_generico/tabla_catalogo_gen_sec', 'CATALOGO DE GENERICOS', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('cat_generico/actualiza_catalogo', 'ACTUALIZA CAT. AS400', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('cat_generico/tabla_catalogo_segpop', 'SEGPOP', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('catalogo_ger/tabla_farmabodega', 'CATALOGO DE FARMABODEGA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
echo anchor('cat_generico/tabla_catalogo_espe', 'CATALOGO DE ESPECIALIDAD', 'class="button-link green" style="position:relative; width:190px; height:20px;"');
echo ('<br /><br />');
}

	$this->load->view('sidebar/login');
?>
      </div>