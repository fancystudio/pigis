console.log("robi");
$(document).ready(function() {
	console.log("dorobilo");
	$('#fullpage').fullpage({
		verticalCentered: false,
		anchors: ['domov', 'onas', 'jedalny-listok', 'galeria', 'nauc-sa-chefovat', 'kontakt'],
		'scrollOverflow': false,
		menu: '#menu',
		paddingTop: '7%',
		scrollingSpeed: 1000,
		keyboardScrolling: true,
		slidesNavigation: true,	
		resize: false,
		autoScrolling: false,
		continuousVertical : true,
		easing: 'linear'
	});
	hashTag = window.location.hash;
	isHashFromBlog = isHashFromBlog(hashTag);
	if(isHashFromBlog){
		loadBlogDetailAndShow(window.location.hash, "pageInit");
	}
	$.ajax({
		type: "POST",
		url: "lib/getBlogContentAjax.php",
		data: {
			currentPage : 1,
			contentHashId : (isHashFromBlog ? hashTag.substr(18) : "")
		},
		beforeSend: function(){},
		success: function(response){
			if(response.status == "success"){
				$(".blogContent .blogThumbs").html(response.content);
				$('.pagination').bootpag({
			        total: response.totalPage,
			        page: response.currentPage,
			        next: 'staršie »',
				    prev: '« novšie'
			    }).on("page", function(event, num){
			    	$.ajax({
			    		type: "POST",
			    		url: "lib/getBlogContentAjax.php",
			    		data: {
				    		currentPage : num,
				    		contentHashId : ""
			    		},
			    		beforeSend: function(){},
			    		success: function(response){
			    			if(response.status == "success"){
		    					$(".blogContent .blogThumbs").fadeOut(function(){
			    					$(".blogContent .blogThumbs").html(response.content).fadeIn();
			    				});
		    				}else{
		    					alert("Nepodarilo sa nacitat blog");
		    				}     
			    		},
			    		error: function(response){
			    			alert("Nepodarilo sa nacitat blog");
			    		}
			    	});
			    });
			}else{
				alert("Nepodarilo sa nacitat blog");
			}     
		},
		error: function(response){
			alert("Nepodarilo sa nacitat blog");
		}
	});
	newsletterSend();
	//googleMapinitialize();
});
function isHashFromBlog(hashTag){
	if(hashTag != "#domov"
		&& hashTag != "#onas"
		&& hashTag != "#jedalny-listok"
		&& hashTag != "#galeria"
		&& hashTag != "#nauc-sa-chefovat"
		&& hashTag != "#kontakt"
		&& hashTag.substr(0, 18) == "#nauc-sa-chefovat-" 
		&& isNumber(hashTag.substr(18))
		){
		return true;
	}else{
		return false;
	}
}
function loadBlogDetailAndShow(hashTag, typeOfRequest){
	if(hashTag.substr(0, 18) == "#nauc-sa-chefovat-" && isNumber(hashTag.substr(18))){
		blogId = hashTag.substr(18);
		console.log(hashTag);
		if(typeOfRequest == "pageInit"){
			$.fn.fullpage.moveTo(5); //slajd na blog sekciu
		}
		$.ajax({
    		type: "POST",
    		url: "lib/getBlogDetailAjax.php",
    		data: {
				blogId : blogId
    		},
    		beforeSend: function(){},
    		success: function(response){
    			if(response.status == "success"){
    				$(".blogContent .blogModal").html(response.content);
					$(hashTag).modal('show');
					$.fn.fullpage.setAutoScrolling(true);
					$.fn.fullpage.setAllowScrolling(false);
					$(hashTag).on('hidden.bs.modal', function (e) {
						window.location.hash = 'nauc-sa-chefovat';
						$.fn.fullpage.setAutoScrolling(false);
						$.fn.fullpage.setAllowScrolling(true);
					});
					FB.XFBML.parse(); 
				}else{
					alert("Nepodarilo sa nacitat blog detail");
				}     
    		},
    		error: function(response){
    			alert("Nepodarilo sa nacitat blog detail");
    		}
    	});
	}
}
function newsletterSend() {
	$(".newsletterButton").click(function(){
		var $infoPanel = $(this).siblings(".sendNewsletterStatus");
		$infoPanel.html("").removeClass("alert").removeClass("alert-success").removeClass("alert-danger");
		if(isValidEmailAddress($(".newsletterEmail").val(),$infoPanel)){
			$.ajax({
				type: "POST",
				url: "lib/setMailToNewsletter.php",
				data: {
					mail: $(".newsletterEmail").val()
				},
				beforeSend: function(){},
				success: function(response){
					if(response.status == "success"){
						$infoPanel.html("Váš email bol pridaný do odberu noviniek").addClass("alert").addClass("alert-success");
    				}else{
    					$infoPanel.html("Váš email sa nepodarilo pridať do odberu noviniek").addClass("alert").addClass("alert-danger");
    				} 
				},
				error: function(response){
					$infoPanel.html("Váš email sa nepodarilo pridať do odberu noviniek").addClass("alert").addClass("alert-danger");
				}
			});
		}
	});
}
function isValidEmailAddress(emailAddress, infoPanel) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    if(pattern.test(emailAddress)){
    	return true;
    }else{
    	infoPanel.html("Email nebol zadaný, alebo bol zadaný nesprávne").addClass("alert").addClass("alert-danger");
    	return false;
    }
}
function isNumber(value) {
	if ((undefined === value) || (null === value)) {
        return false;
    }
    if (typeof value == 'number') {
        return true;
    }
    return !isNaN(value - 0);
}
var map;
function googleMapinitialize() {        
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
	
	var isDraggable = $(document).width() > 720 ? true : false; // zisti ci je mobil
	
	var options = {
	scrollwheel: false,
	navigationControl: false,
	    mapTypeControl: false,
	    scaleControl: false,
	    draggable: isDraggable,
		mapTypeControlOptions: { mapTypeIds: [ 'Styled']},
		center: new google.maps.LatLng(48.73189, 19.14155),
		zoom: 17,
		mapTypeId: 'Styled',
	
	};
	
	var div = document.getElementById('gmap');
	var map = new google.maps.Map(div, options);
	var myLatlng = new google.maps.LatLng(48.732891, 19.141550);
	var image = 'img/marker.png';
	var marker = new google.maps.Marker({
	  position: myLatlng,
	  map: map,
	  title: 'pigis',
	  icon: image
	});
	
	var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
	map.mapTypes.set('Styled', styledMapType);
}
google.maps.event.addDomListener(window, 'load', googleMapinitialize);



