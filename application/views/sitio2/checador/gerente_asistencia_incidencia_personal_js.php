<script>

var $comprobantes = $("#comprobantes-validos");

$("form input:radio").on('click', function(){
   var $alt = $(this).attr('alt');
   
   $comprobantes.html("Para hacer valida esta hoja de incidencia debes presentar una copia de: <br />" + $alt).css('color', 'red').css('font-size', '20px');
   
});


$("#forma-incidencias").on('submit', function(event){
    event.preventDefault();
    
    var $url = $(this).attr('action');
    var $asistencia = $( "input[name='id']" ).attr('value');
    var $justificacion = $( "form input:radio:checked" ).val();
    var $observaciones = $("form textarea#observaciones").val();
    
    var $variables = {
      asistencia: $asistencia,
      justificacion: $justificacion,
      observaciones: $observaciones  
    };
    
    if ($justificacion != null){
        
        var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            if ( data > 0)
            {
                window.location.href = '<?php echo site_url('checador/gerente_detalle_empleado_periodo').'/'.$this->uri->segment(3, 0).'/'.$this->uri->segment(4, 0).'/'.$this->uri->segment(5, 0);?>';
            }else{
                alert("Algo fallo, comunicate a soporte.")
            }
         });
         
     }else{
        alert("Elige un motivo.")
     }

});

</script>