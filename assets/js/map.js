jQuery(document).ready(function( $ ) {
	function initMap() {
        var map = new google.maps.Map(document.getElementById('solid-map'), {
          center: {lat: parseInt(solid_map.lat), lng: parseInt(solid_map.lng)},
          zoom: parseInt(solid_map.zoom)
        });
      }
    initMap();
});