<div id="links">
<?php
    $is_logged_in = $this->session->userdata('is_logged_in');
    $razon = $this->session->userdata('razon');
    $nivel = $this->session->userdata('nivel');
    $suc = $this->session->userdata('username');


    if($is_logged_in == FALSE){

?>

<?php
	}elseif($is_logged_in == TRUE && ($nivel == 2 && ($suc==102 ||$suc==103 ||$suc==105 ||$suc==141 ||$suc==108
 ||$suc==109 ||$suc==124 ||$suc==115 ||$suc==107 ||$suc==129 ||$suc==202 ||$suc==112))){
?>

<?php

echo anchor('captura_pedido1', 'CAPTURA DE PEDIDO ESPECIAL', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>
<br /><br />

<?php

echo anchor('captura_pedido1/pedidos_en_captura', 'PEDIDOS EN CAPTURA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>
<br /><br />


<?php
	} 
    elseif($is_logged_in == TRUE && $razon == 'D' || $razon == 'G' && $nivel == 2 ){
?>

<!-- TeamViewer Logo (generated at http://www.teamviewer.com) -->
<div style="position:relative; width:150px; height:125px;">
  <a href="http://201.151.238.53/f/programas/TeamViewerQS_win98.exe" style="text-decoration:none;" target="_blank">
    <img src="http://www.teamviewer.com/link/?url=246800&id=497992611" alt="Descargar versión completa de TeamViewer" title="Descargar versión completa de TeamViewer" border="0" width="200" height="125" />
    <span style="position:absolute; top:83.5px; left:5px; display:block; cursor:pointer; color:White; font-family:Arial; font-size:15px; line-height:1.2em; font-weight:bold; text-align:center; width:190px;">
      Soporte Remoto TeamViewer
    </span>
  </a>
</div>
    



<br />
<?php

echo anchor('pdv', 'Tutorial para Actualizar <br/>
    EL PUNTO DE VENTA YUCIF <br/> 18 de FEBRERO 2013', 'class="button-link red" style="position:relative; width:190px; height:80px;"');
?>

<br /><br />
<?php
	echo anchor('tuto_tiempo', 'Tutorial para configurar y<br/>
    descargar el Mozilla Firefox<br/>PUNTO DE VENTA YUCIF', 'class="button-link blue" style="position:relative; width:190px; height:80px;"');
?>
<br /><br />

<?php
	echo anchor('pdv1', 'Problemas con la reimpresion<br/> de tickets', 'class="button-link red" style="position:relative; width:190px; height:80px;"');
?>
<br /><br />


<?php
//	echo anchor('tuto_backoffice', 'Tutorial para configurar y <br/>
//    descargar Internet Explorer<br/>PDV BACKOFFICE', 'class="button-link blue"');
?>

<?php
	echo anchor('tuto', 'Descarga de los tutoriales:<br/>
    TIEMPO AIRE Y<br/>FAC. ELECTRONICA', 'class="button-link blue" style="position:relative; width:190px; height:80px;"');
?>
<br /><br />


<script src="<?php echo base_url();?>scripts/minified/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.dialog.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(function() {
		$( "#dialog" ).dialog();
});
</script>


<?php
    $suc = $this->session->userdata('suc');
  




	}elseif($is_logged_in == TRUE && $nivel == 16){
?>

<?php

echo anchor('captura_pedido1/pedidos_en_captura', 'PEDIDOS EN CAPTURA', 'class="button-link green"');

?>
<br /><br />

<?php

echo anchor('captura_pedido1/historico_de_pedidos_esp', 'HISTORICO DE PEDIDOS', 'class="button-link green"');

?>
<br /><br />

<?php
	}elseif($is_logged_in == TRUE && $nivel == 15){
?>

<?php

echo anchor('captura_pedido1', 'CAPTURA DE PEDIDO ESPECIAL', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>
<br /><br />

<?php

echo anchor('captura_pedido1/pedidos_en_captura', 'PEDIDOS EN CAPTURA', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>
<br /><br />

<?php

echo anchor('captura_pedido1/historico_de_pedidos_esp', 'HISTORICO DE PEDIDOS', 'class="button-link green" style="position:relative; width:190px; height:20px;"');

?>
<br /><br />



<?php
	}elseif($is_logged_in == TRUE && $nivel == 10 ){
?>

<?php

echo anchor('captura_pedido1/historico_de_pedidos_esp', 'HISTORICO DE PEDIDOS', 'class="button-link green"');

?>
<br /><br />

<?php
	}elseif($is_logged_in == TRUE && $razon == 'F'){
?>

<script src="<?php echo base_url();?>scripts/minified/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.dialog.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(function() {
		$( "#dialog" ).dialog();
});
</script>




<?php

//echo anchor('pfizer', '<img src="'.base_url().'img/pfizer.png" border="0" align="middle" width="100%" /><br /><br />');

?>


<?php
	}
?>



</div>