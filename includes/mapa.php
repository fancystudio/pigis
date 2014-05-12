<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
function initialize() {
        
     
        
var styles = [
	{
		featureType: 'landscape',
		elementType: 'all',
		stylers: [
			{ hue: '#b4a796' },
			{ saturation: -38 },
			{ lightness: -27 },
			{ visibility: 'on' }
		]
	}
];

var options = {
scrollwheel: false,
navigationControl: false,
    mapTypeControl: false,
    scaleControl: false,
    draggable: true,
	mapTypeControlOptions: {
		mapTypeIds: [ 'Styled']
	},
	center: new google.maps.LatLng(48.74818, 19.65134),
	zoom: 17,
	mapTypeId: 'Styled',

};

 


var div = document.getElementById('map');
var map = new google.maps.Map(div, options);
var myLatlng = new google.maps.LatLng(48.74818, 19.65134);
var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Chata Čierny Balog'
  });



var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });



map.mapTypes.set('Styled', styledMapType);}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
      <div id="map"></div>