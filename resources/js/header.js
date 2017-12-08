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

    var showDrawer = function(elem) {  
      var pos = -100;
      var id = setInterval(frame, 3);
      function frame() {
        if (pos >= 0) {
          clearInterval(id);
        } else {
          pos+=4;
          elem.style.left = pos + 'px'; 
        }
      }
    }

    showDrawer(document.getElementById("drawer"));

	});

	document.getElementById("drawer-modal").addEventListener("click", function(){
		
		document.getElementById("drawer-modal").style.visibility = "hidden";
		document.getElementById("drawer").style.visibility = "hidden";

	});

});

function getFecha(extra_days){
  
   var pad = (n) => {return n<10 ? '0'+n : n};

   var date = new Date();
   date.setTime(date.getTime() + (extra_days * 86400000));
   var day = pad(date.getDate());
   var month = pad(date.getMonth() + 1);
   var year = pad(date.getFullYear());
   return  year + '-' + month + '-' + day;
}