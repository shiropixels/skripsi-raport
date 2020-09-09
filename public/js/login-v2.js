// var btnX = document.getElementById("login-button");
// var btnY = document.getElementById("submit-button");
// var x = document.getElementById("login-form");
// var y = document.getElementById("register-form");

function login(){
	document.getElementById("register-tab").className = "btn";
	document.getElementById("login-tab").className = "btn-active";
	$(".register").hide(); $(".login").show(); 
}

function register(){
	document.getElementById("register-tab").className = "btn-active";
	document.getElementById("login-tab").className = "btn";
	// document.getElementByid("register-form").style.display = "Grid";
	$(".register").show(); $(".login").hide(); 
}

