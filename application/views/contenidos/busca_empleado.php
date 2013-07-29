<h4>Busqueda de Empleados</h4>
          <p>
            <input class="search" type="text" name="search_field" id="search_field" placeholder="Teclea palabra de busqueda"/>
          </p>

<div align="center" id="tabla" style="width: 100%; height: 175px; overflow: auto;"></div>

<script language="javascript" type="text/javascript">
   
   $('#search_field').keyup(
                function()
                {
                var busqueda= $('#search_field').attr("value");
                var longitud = $('#search_field').attr("value").length;
                
                if(longitud >= 3){
                    
                    $.post("<?php echo site_url();?>/prenomina/empleado/", { busqueda: busqueda }, function(data){
                    $("#tabla").html(data);
                });
           }else{


           }
           
           });
           
</script>