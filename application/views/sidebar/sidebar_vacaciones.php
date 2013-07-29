      <div class="sidebar">
<?php
	$this->load->view('sidebar/login');
    echo anchor('vacaciones/captura_vacaciones', 'FORMATO DE VACACIONES', 'class="button-link gray", style="position:relative; width:190px; height:20px;"');
    echo anchor('vacaciones/historico_vacaciones', 'HISTORICO DE VACACIONES', 'class="button-link gray", style="position:relative; width:190px; height:20px;"');
    echo '<br />';
    echo '<br />';
    echo anchor('vacaciones/salidas_de_personal', 'SALIDAS DE PERSONAL', 'class="button-link green", style="position:relative; width:190px; height:20px;"');
    echo anchor('vacaciones/historico_salidas', 'HISTORICO DE SALIDAS', 'class="button-link green", style="position:relative; width:190px; height:20px;"');
?>




      </div>

