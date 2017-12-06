window.onload = function (){

	document.getElementById("drawer-toggle").addEventListener("click", function(){
		
		document.getElementById("drawer-modal").style.visibility = "visible";
		document.getElementById("drawer").style.visibility = "visible";

	});

	document.getElementById("drawer-modal").addEventListener("click", function(){
		
		document.getElementById("drawer-modal").style.visibility = "hidden";
		document.getElementById("drawer").style.visibility = "hidden";

	});



}