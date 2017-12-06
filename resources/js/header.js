function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function (){

	document.getElementById("drawer-toggle").addEventListener("click", function(){
		
		document.getElementById("drawer-modal").style.visibility = "visible";
		document.getElementById("drawer").style.visibility = "visible";

	});

	document.getElementById("drawer-modal").addEventListener("click", function(){
		
		document.getElementById("drawer-modal").style.visibility = "hidden";
		document.getElementById("drawer").style.visibility = "hidden";

	});

});