<div align="center">
<h1>Back Office envio de inventario semanal</h1>

<div align="center">
        <span id="upload_button">Da click aqui para seleccionar un archivo para envio.</span>
        
</div>          
        <span id="archivo">
        </span>

</div>
<div align="center">
<?php
	echo anchor('backoffice/inv_ftpback', 'Actualizar inventarios');
?>
</div>

<div id="tabla" align="center" style="clear: both;">
<?php
	$this->load->view('contenidos/back_tabla_pedidos');
?>
</div>
<script language="javascript" type="text/javascript"> 


	var button = $('#upload_button'), interval;

	new AjaxUpload('#upload_button', {

        action: '<?php echo site_url();?>/backoffice/upload',

		onSubmit : function(file , ext){

		if (! (ext && /^(txt)$/.test(ext))){

			// extensiones permitidas

			alert('Error: Solo se permiten .txt, .csv');

			// cancela upload

			return false;

		} else {

			button.text('Subiendo el  archivo. Espere un momento por favor.....');

			this.disable();

		}

		},

		onComplete: function(file, response){

			button.text('Da click aqui para seleccionar un arhivo para envio.');

			// enable upload button

			this.enable();

			// Agrega archivo a la lista

			$.post('<?php echo site_url();?>/backoffice/tabla_pedidos', function(data) {
                $('#tabla').html(data);
            });

			//$('#imagen_alt').val(file);

		}

	});


</script>
