<div align="center" id="tabla" style="width: 100%; height: 175px; overflow: auto;"></div>
<div id="map_canvas" style="float:left;width:100%; height:400px; margin-top: 20px;"></div>
<div id="como_llegar" style="margin-top: 20px; margin-bottom: 10px;">
<p>Traza una ruta para saber como llegar a la sucursal.</p>
<h2>Como llegar ?</h2>
<input type="text" size="45" maxlength="100" name="origen" id="origen" />
<input type="hidden" name="destino" id="destino" value=""/>
<input type="hidden" name="latitud" id="latitud" value=""/>
<input type="hidden" name="longitud" id="longitud" value=""/>
<button id="ruta_boton" onclick="ruta();">Traza Ruta</button>
</div>


<script language="javascript" type="text/javascript">
function initialize() {
    var latlng = new google.maps.LatLng(19.43251448141914, -99.13324356079102);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    $('#como_llegar').hide();
    $('#instrucciones').hide();
  }

function tabla_cp(){
    
    var codigo = document.getElementById("cp").value;
    $.post("<?php echo site_url();?>/sucursales/busca_cp/", { codigo: codigo }, function(data){
                    $("#tabla").html(data);
                });
                
                
}

        $('#edo').change(
                function()
                {
                var edo= $('#edo').attr("value");
                
                if(edo != 0){
                    
                    $.post("<?php echo site_url();?>/sucursales/busca_municipios/", { edo: edo }, function(data){
                    $("#municipio").html(data);
                });
           }else{
            $("#municipio").html('');
           }
           
           });


        $('#municipio').change(
                function()
                {
                var edo= $('#edo').attr("value");
                var municipio= $('#municipio').attr("value");
                
                if(edo != 0 && municipio != 0){
                    
                    $.post("<?php echo site_url();?>/sucursales/busca_edo_municipio/", { edo: edo, municipio: municipio }, function(data){
                    $("#tabla").html(data);
                });
           }else{


           }
           
           });


        $('#search_field').keyup(
                function()
                {
                var busqueda= $('#search_field').attr("value");
                var longitud = $('#search_field').attr("value").length;
                
                if(longitud >= 3){
                    
                    $.post("<?php echo site_url();?>/sucursales/busca_sucursal/", { busqueda: busqueda }, function(data){
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
  
  
  $.post("<?php echo site_url();?>/sucursales/detalle_sucursal/", { suc: suc }, function(data){
                    $("#datos").html(data);
                });
                
  
      $('#como_llegar').show('slow');
      $('#destino').val(lat + ', ' + lon);
      $('#latitud').val(lat);
      $('#longitud').val(lon);

  }
  
  function ruta()
  {
     $('#origen_destino').html('');
     $('#sidebar_busqueda').hide('slow');
     $('#instrucciones').show('slow');
     initialize2();
     calcRoute();
  }
  
  function reset()
  {
     $('#sidebar_busqueda').show('slow');
     $('#instrucciones').hide('slow');
  }
  
  
  
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var oldDirections = [];
  var currentDirections = null;
 
  function initialize2() {
    
    var latitud = document.getElementById("latitud").value;
    var longitud = document.getElementById("longitud").value;
    
    var myOptions = {
      zoom: 13,
      center: new google.maps.LatLng(latitud, longitud),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
    directionsDisplay = new google.maps.DirectionsRenderer({
        'map': map,
        'preserveViewport': true,
        'draggable': true
    });
    directionsDisplay.setPanel(document.getElementById("origen_destino"));
 
    google.maps.event.addListener(directionsDisplay, 'directions_changed',
      function() {
        if (currentDirections) {
         // oldDirections.html(currentDirections);
          //setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });
 
    //setUndoDisabled(true);
 
    //calcRoute();
  }
 
  function calcRoute() {
    
    var start = document.getElementById("origen").value;
    var end = document.getElementById("destino").value;
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }

  
  


</script>
