<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.button.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.dialog.min.js"></script>
<script src="<?php echo base_url();?>fenix2/js/AjaxUpload.2.0.min.js"></script>
<script type='text/javascript' language="javascript">
$( "a[id^='validar_']" ).on('click', function(event){
    
    event.preventDefault();
    
    var $url = $(this).attr('href');
    
    if(confirm("Estas seguro que deseas VALIDAR esta INCIDENCIA ?")){
            var posting = $.post( $url );
            
            posting.done(function( data ) {
                if ( data > 0)
                {
                    window.location.reload();
                }else{
                    alert("Algo fallo, comunicate a soporte.")
                }
            });
            
            return true;
    }else{
        return false;
    }
});

$( "a[id^='rechazar_']" ).on('click', function(event){
    
    event.preventDefault();
    
    var $url = $(this).attr('href');
    
    if(confirm("Estas seguro que deseas RECHAZAR esta INCIDENCIA ?")){
            var posting = $.post( $url );
            
            posting.done(function( data ) {
                if ( data > 0)
                {
                    window.location.reload();
                }else{
                    alert("Algo fallo, comunicate a soporte.")
                }
            });
            
            return true;
    }else{
        return false;
    }
});

$('button[id^="upload_button_"]').on("click", comprobante);
$('a[id^="comprobantes_"]').on("click", ver_comprobantes);

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
    			button.text('Subiendo...');
    			this.disable();
    		  }
    		},
    		onComplete: function(file, response){
    			button.text('...');
    			this.enable();
    		}	
    
    	});
    }


</script>