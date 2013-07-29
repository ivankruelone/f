      <div class="sidebar">

<?php
$nivel = $this->session->userdata('nivel');
$tipo = $this->session->userdata('tipo');
$dia=date('d');

"
<table>
<tr>";

if($nivel==7 && $tipo==0){
    echo "<strong><br />NOMINAS</strong>";
echo anchor('envio/tabla_poliza', 'PRENOMINAS  POR CONTADOR<br />', 'class="button-link pink"');
echo anchor('envio/tabla_poliza_con', 'PRENOMINAS  POR CONCEPTO<br />', 'class="button-link pink1"');
echo anchor('envio/tabla_poliza_cia', 'PRENOMINAS  POR COMPA&Ntilde;IA<br />', 'class="button-link pink1"');
if($dia>=8 && $dia<=15 || $dia>=22 and $dia<=31){
echo anchor('envio/tabla_envio_faltantes', 'ENVIO INFORMACION A AS/400 <br />', 'class="button-link green"');
echo ('<br /><br />');
echo anchor('envio/tabla_envio_incapacidad', 'INCAPACIDAD MAYOR A 15<br />', 'class="button-link green"');
}    
}
if($nivel==7 && $tipo==1){
    echo "<strong><br />NOMINAS</strong>";
echo anchor('envio/tabla_poliza_con', 'PRENOMINAS  POR CONCEPTO<br />', 'class="button-link pink1"');
}
?>
<?php
	$this->load->view('sidebar/login');
?>
      </div>
