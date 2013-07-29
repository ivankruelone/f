
<?php
	if(isset($id)){
?>
<div align="center">
<p class="message-box ok">Sus cambios se guardaron con exito.</p>
</div>
<?php
	}
?>



<div align="center" id="tabla" style="width: 100%; height: 175px; overflow: auto;"></div>
<div id="imagen" style="width: 100%; margin-top: 15px; margin-bottom: 15px;"></div>
<div id="datos" style="width: 100%; margin-top: 15px; margin-bottom: 15px;"></div>



<script language="javascript" type="text/javascript">
function initialize() {
    var latlng = new google.maps.LatLng(19.44838888, -99.1899166670000);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }

function tabla_cp(){
    
    var codigo = document.getElementById("cp").value;
    $.post("<?php echo site_url();?>/sucursales/busca_cp/", { codigo: codigo }, function(data){
                    $("#tabla").html(data);
                });
                
}


        $('#search_field').keyup(
                function()
                {
                var busqueda= $('#search_field').attr("value");
                var longitud = $('#search_field').attr("value").length;
                
                if(longitud >= 3){
                    
                    $.post("<?php echo site_url();?>/directorio/busca_sucursal/", { busqueda: busqueda }, function(data){
                    $("#tabla").html(data);
                });
           }else{


           }
           
           });
           
        
        $('#search_field1').keyup(
                function()
                {
                var busqueda= $('#search_field1').attr("value");
                var longitud = $('#search_field1').attr("value").length;
                
                if(longitud >= 3){
                    
                    $.post("<?php echo site_url();?>/directorio/busca_personal/", { busqueda: busqueda }, function(data){
                    $("#tabla").html(data);
                });
           }else{


           }
           
           });


  function busca(lat, lon, direccion, suc) {
    latlng = new google.maps.LatLng(lat, lon);
    myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    var marker = new google.maps.Marker({
      position: latlng, 
      map: map, 
      title: direccion
  }); 
  
  
  $.post("<?php echo site_url();?>/directorio/detalle_sucursal/", { suc: suc }, function(data){
                    $("#datos").html(data);
                });
  
  }
  


</script>

