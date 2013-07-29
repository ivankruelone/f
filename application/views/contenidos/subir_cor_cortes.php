<p>Subir archivo .ZIP de cortes  XXXXXXXXX.crt</p><br />

<?php
	        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        $ip_address = $this->session->userdata('ip_address');
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            
            }else{

?>

<h2>Enviar su Archivo</h2>

<div style="margin-bottom: 40px;">
        <span id="upload_button">Da click aqui para seleccionar un arhivo para envio.</span>
        
</div>          
        <span id="archivo">
        </span>
        


<br /><br />

        <?php
	}
?>

<script language="javascript" type="text/javascript"> 


	var button = $('#upload_button'), interval;

	new AjaxUpload('#upload_button', {

        action: '<?php echo site_url();?>/cor_cortes/upload',

		onSubmit : function(file , ext){

		if (! (ext && /^(crt)$/.test(ext))){

			// extensiones permitidas

			alert('Error: Solo se permiten .crt');

			// cancela upload

			return false;

		} else {

			button.text('Subiendo el  archivo. Espere un momento por favor...');

			this.disable();

		}

		},

		onComplete: function(file, response){

			button.text('Da click aqui para seleccionar un arhivo para envio.');

			// enable upload button

			this.enable();

			// Agrega archivo a la lista

			$('#archivo').append(response);

			//$('#imagen_alt').val(file);

		}

	});


</script>