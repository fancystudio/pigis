$(document).ready(function() {
	$('#fullpage').fullpage({
		verticalCentered: false,
		anchors: ['domov', 'onas', 'jedalny-listok', 'galeria', 'nauc-sa-chefovat', 'kontakt'],
		'scrollOverflow': false,
		menu: '#menu',
		paddingTop: '7%',
		keyboardScrolling: true,
		slidesNavigation: true,	
		resize: false,
		autoScrolling: false
	});
	$( ".blogContent" ).load( "lib/getBlogContentAjax.php", 
		{ 
			currentPage : 1
		}, function( response, status, xhr ) {
			if(status == "success"){
				$('.pagination').bootpag({
			        total: $(".currentPage").html()
			    }).on("page", function(event, num){
			    	$( ".blogContent" ).load( "lib/getBlogContentAjax.php", 
		    			{ 
			    		currentPage : num
		    			}, function( response, status, xhr ) {
		    				if(status == "success"){
		    					console.log("Prepnutie stranky");
		    				}else{
		    					alert("Nepodarilo sa nacitat blog");
		    				}
		    			} 
		    		);
			    });
			}else{
				alert("Nepodarilo sa nacitat blog");
			}
		} 
	);
	$(".showBlogModal").click(function(){
        window.location.hash = $(this).attr("id");
	});
	$(".newsletterButton").click(function(){
		if(isValidEmailAddress($(".newsletterEmail").val(),"errorClass")){
			$.ajax({
				type: "POST",
				url: "lib/setMailToNewsletter.php",
				data: {
					mail: $(".newsletterEmail").val()
				},
				beforeSend: function() 
				{
					//sem dat gifko
				},
				success: function(response)
				{
					console.log(response.status);
				},
				error: function(response)
				{
					console.log(response.status);
				}
			});
		}
	});
	
});
function isValidEmailAddress(emailAddress,errorClass) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    if(pattern.test(emailAddress)){
    	//$(errorClass).hide();
    }else{
    	//$(errorClass).show();
    }
    return pattern.test(emailAddress);
}
var map;
function initialize() {        
var styles = [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    
    {
           "featureType": "landscape.man_made",
    "elementType": "geometry.stroke",
    "stylers": [
      { "visibility": "on" },
      { "color": "#ffffff" },
      { "hue": "#d4ff00" }
    ]
  },

    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 37
            },
            {
                "weight": 1.2
            }
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
	center: new google.maps.LatLng(48.73289, 19.14155),
	zoom: 17,
	mapTypeId: 'Styled',

};

var div = document.getElementById('gmap');
var map = new google.maps.Map(div, options);
var myLatlng = new google.maps.LatLng(48.73389, 19.14155);
var image = 'img/marker.png';
var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'pigis',
      icon: image
  });

var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
map.mapTypes.set('Styled', styledMapType);}
google.maps.event.addDomListener(window, 'load', initialize);




