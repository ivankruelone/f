<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.button.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.dialog.min.js"></script>
<script src="<?php echo base_url();?>fenix2/js/AjaxUpload.2.0.min.js"></script>
<script type='text/javascript' language="javascript">
    $(document).on("ready", inicio);
	function inicio(){
	   
       
	}
    
    $('a[id^="justifica_"]').on("click", justifica);
    $('a[id^="comprobantes_"]').on("click", ver_comprobantes);
    $('a[id^="quita_"]').on("click", no_justifica);
    $('button[id^="upload_button_"]').on("click", comprobante);
    
    function justifica(datos) {
        datos.preventDefault();
        
                    var liga = datos.currentTarget.attributes.href.value;
                    $( "#dialog" ).dialog({
            			autoOpen: true,
                        title: "Detalles de la asistencia",
                        open: function ()
                        {
                            $(this).load(liga);
                        }
            		});

                    return false;
    }
    
    function ver_comprobantes(datos) {
        datos.preventDefault();
        
                    var liga = datos.currentTarget.attributes.href.value;
                    $( "#dialog2" ).dialog({
            			autoOpen: true,
                        width: 600,
                        title: "Comprobantes",
                        open: function ()
                        {
                            $(this).load(liga);
                        }
            		});

                    return false;
    }

    function no_justifica(datos){
        datos.preventDefault();

        var url = datos.currentTarget.attributes.href.value
        
        $.post( url, null, function(data) {
            if(data = 1)
            {
                window.location.reload();
            }
        });
        
    }
    
    
    function comprobante(datos)
    {
        var $boton = datos.currentTarget.attributes.id.value;
        var $variables = $boton.split('_');
        $id = $variables[2];
        sube($boton, $id);
    }
    
    function sube($boton, $id){
       	var button = $('#' + $boton), interval;
    	new AjaxUpload('#' + $boton, {
            action: '<?php echo site_url();?>/checador/upload_comprobante/' + $id,
    		onSubmit : function(file , ext){
    		if (! (ext && /^(png|jpg|gif)$/.test(ext))){
    			alert('Error: Solo se permiten .jpg, .png, .gif');
    			return false;
    		} else {
    			button.text('Subiendo el  archivo. Espere un momento por favor...');
    			this.disable();
    		  }
    		},
    		onComplete: function(file, response){
    			button.text('Comprobante');
    			this.enable();
    		}	
    
    	});
    }
</script>
