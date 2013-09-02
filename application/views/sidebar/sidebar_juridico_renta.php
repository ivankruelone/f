      <div class="sidebar">


<?php
$nivel=$this->session->userdata('nivel');
$tipo=$this->session->userdata('tipo');
if($nivel==31 and $tipo==2){
echo anchor('juridico/tabla_rentas_mensuales', 'Rentas del mes <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('juridico/tabla_retencion', 'RETENCION DE SALARIO<br />', 'class="button-link blue"');
echo ('<br /><br />');

    
}else{
echo anchor('juridico/tabla_rentas_genera', 'GENERA RENTAS DEL MES <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('juridico/tabla_rentas_mensual', 'VISUALIZAR RENTAS DEL MES <br />', 'class="button-link blue"');
echo ('<br /><br />');
echo anchor('juridico/tabla_rentas_mensual_historico', 'VISUALIZAR RENTAS DEL MES HISTORICO<br />', 'class="button-link blue"');
echo ('<br /><br />');
    
}
	$this->load->view('sidebar/login');
?>
      </div>
