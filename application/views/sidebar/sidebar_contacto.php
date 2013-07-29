<div class="sidebar">

<?php
	$this->load->view('sidebar/login');
?>

<?php
	$this->load->view('sidebar/links');
?>

<?php
	$busqueda = $this->input->post('busqueda');
        $is_logged_in = $this->session->userdata('is_logged_in');
            $ip_address = $this->session->userdata('ip_address');
            $nivel = $this->session->userdata('nivel');
            
            if($nivel == 4 || $nivel == 3 || $nivel == null || $nivel == 1){
?>

<div style="margin-top: 25px;">

								
								<img src="<?php echo base_url();?>imagenes/latest_tweet.png"  align="right" width="20%"/>
                                <br />
                                <h2 style="font-size: 18px;">Oficinas Centrales</h2><hr />
									
								
								<p><strong>Direcci&oacute;n:</strong><br/>Calle Lago Trasimeno #36, <br /> Col. Anahuac C.P. 11320<br/>Distrito Federal, M&eacute;xico<br />RFC: FFC6611235C0</p><hr />
								
                                <strong>Email:</strong> <a href="contacto@farmaciaselfenix.com.mx" target="_blank">contacto@farmaciaselfenix.com.mx</a><br/><br />
								<strong>Website:</strong> <a href="http://www.farmaciaselfenix.com.mx" target="_blank">www.farmaciaselfenix.com.mx</a><br/><br />
								<strong>Tel&eacute;fono:</strong> 91-400-700 <br />	<br />
                                <strong>Fax:</strong> 91-400-700
</div>


<?php
	}elseif($nivel == 2){

?>
    <h2 style="font-size: 18px;">Inventarios y Pedidos</h2><hr /><br />
    
    <h4>ENCARGADO DE INVENTARIOS</h4>
    
    <p>Marco Antonio Zacarias L&oacute;pez<br />
    marco.zack@farfenix.com.mx<br />
    extensi&oacute;n 677</p>
    
    <h4>ENCARGADA DE REPORTE DE VENTAS Y PEDIDOS</h4>
    
    <p>Laura Garc&iacute;a P&eacute;rez<br />
    laura.sistemas@farfenix.com.mx<br />
    extensi&oacute;n 677</p>

    <h2 style="font-size: 18px;">Soporte T&eacute;cnico</h2><hr />
    <p>Mario  E. Camacho Elias<br />
    mario.camacho@farfenix.com.mx<br />
    extensi&oacute;n 175<br /><br />
    
    Javier Vicente Rivera<br />
    extensi&oacute;n 175<br /><br />
    
    Francisco E Romero Pizano<br />
    extensi&oacute;n 175<br /><br />
    
    Rafael Madrigal L&oacute;pez<br />
    extensi&oacute;n 627<br /><br />
    
    Hermes Castillo Monroy<br />
    extensi&oacute;n 627<br /><br />
    
    Adolfo Arriaga Bastida<br />
    extensi&oacute;n 627<br /><br />
    </p>

<?php
	}
?>
						
    </div>