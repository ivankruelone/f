<script type="text/javascript">
$(document).on("ready", inicio);
function inicio () 
{
	$("#fec1").datepicker({ dateFormat: "yy-mm-dd", dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ], monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]});
	$("#fec2").datepicker({ dateFormat: "yy-mm-dd", dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ], monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]});





}
</script>

<script language="javascript" type="text/javascript">
    
    
    $(document).ready(function(){
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#memo').submit(function(event){
        
        
        var asunto = $('#asunto').attr('value');
            
        if(asunto == 0) {
            alert('Debes seleccionar el asunto.');
            event.preventDefault();
        }else{ 
        
       
            /////////////inicio
           if(confirm("Seguro que la inf. es correcta?")){
            return true;
            
           } else{
            //evita que se ejecute el evento
            event.preventDefault();
            return false;
           }
           ////////////////fin

          }  
      
      
        
    });          
          
        
     
});
</script>