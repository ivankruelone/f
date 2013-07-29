      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(19.44838888, -99.1899166670000),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
      
      initialize();