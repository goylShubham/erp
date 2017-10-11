window.onclick = function(event){
	if(event.target == document.getElementById('navigation')){
		$(".navigation").css("left","-100%");
	}
}

function snackbar(message){	
	setTimeout(function(){$("#snackbar-div").fadeOut();},2000);
	$("#snackbar-message").html(message);
	$("#snackbar-div").fadeIn("slow");	
}

function verify(type,email,code,vcode){
	$.post("../functions/verify.php",{
		type: type,
		email: email,
		code: code,
		vcode: vcode
	},function(data,status){
		snackbar(data);
	});
}

function request(department_id){
	if(user_id){
		snackbar("Generating request!");
		var cPosition;
		if (navigator.geolocation)
		{
			navigator.geolocation.getCurrentPosition(function(position){
				var geocoder = new google.maps.Geocoder;
				var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
				geocoder.geocode({'location': latlng}, function(results,status){
					if(status === 'OK'){
						if(results[0]){        
							$.post("functions/send_request.php",{
								user_id: user_id,
								department: department_id,
								user_location: String(results[0].formatted_address),
								user_lat: latlng.lat,
								user_lng: latlng.lng
							},function(data,status){
								snackbar(data);
								setTimeout(function(){									
									location.href = "current_report";
								},1000);
							});		
						}else{
							snackbar("No address found!");
						}
					}
				});
			},showError);
		}
		else{
			snackbar("Geolocation not supported.");
			return;
		}
		
	}else{
		snackbar("Please login!");
		setTimeout(function(){
			location.href = 'user_login';
		},1000);
	}
}

$(document).ready(function(){
	$(".menu-icon").click(function(){
		$(".navigation").css("left","0%");
	});

	$(".navigation").click(function(){		
		$(".navigation").css("left","-100%");
	});

	$(".logo-img").click(function(){
		$(location).attr('href','../ierp/');
	});

	$(".user-login-link").click(function(){
		$(location).attr('href','user_login');
	});	

	$(".dep-login-link").click(function(){
		$(location).attr('href','department_login');
	});	

	$(".register-link").click(function(){
		$(location).attr('href','user_register');
	});

	$(".tnc-btn").click(function(){
		$(".tnc-wrapper").show();
	});
});