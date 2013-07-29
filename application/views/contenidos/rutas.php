<h1><?php echo $titulo;?></h1>

<div id="map_canvas" style="float:left;width:100%; height:600px; margin-top: 15px;"></div>
<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?sensor=false">
</script>
<script language="javascript" type="text/javascript">

var map;
function initialize() {
    var latlng = new google.maps.LatLng(19.408318461, -99.0236054111);
    //var latlng = new google.maps.LatLng(19.44838888, -99.1899166670000);
    var myOptions = {
      zoom: 13,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
  
  initialize();
  marcadores();
  
  
  function marcadores(){
    var marker;
    var parliament = new google.maps.LatLng(19.40872222, -99.0362222220000);
    
    marker = new google.maps.Marker({
    map:map,
    draggable:false,
    animation: google.maps.Animation.DROP,
    position: parliament
  });
  google.maps.event.addListener(marker, 'click', toggleBounce);

    function toggleBounce() {
    
      if (marker.getAnimation() != null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }
  }
  
    
</script>