<script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#nombre").focus();
    });
    
    $(document).ready(function(){
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#salida').submit(function(event){
        
        var nombre = $('#nombre').attr('value');
        var asunto = $('#asunto').attr('value');
        var regreso = $('#regreso').attr('value');
        
        if(nombre == 0){
            alert('Debes seleccionar un empleado.');
            event.preventDefault();
        }else{
            
        if(asunto == 0) {
            alert('Debes seleccionar el asunto.');
            event.preventDefault();
        }else{ 
          
        if(regreso == 0) {
            alert('Debes seleccionar si regresara.');
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
        }
        }
        
    });          
          
        
     
});
</script>
  