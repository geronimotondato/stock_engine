//Define la url base del sistema de forma global
var _$_HOME_URL = "/stockeng";

// throttle / debounce 
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

var mostrar_mensaje_error = function(mensaje){
	var mensaje = $.parseHTML(
		"<div id='mensaje-error' class='toast toast-error' style='display: none;'>\
          <button class='btn btn-clear float-right'></button>"+mensaje+"\
        </div>"
     );
	$(mensaje).css("position", "fixed");
	$(mensaje).css("width", "700px");
	$(mensaje).css("min-width", "50%");
	$(mensaje).css("max-width", "90%");
	$(mensaje).css("left", "50%");
	$(mensaje).css("transform", "translate(-50%, 50%)");
	$(mensaje).css("z-index", "1000");
	$(mensaje).css("margin", "0 auto");
	$("button", $(mensaje)).click(function(){
		$("#mensaje-error").remove()
	});
	$(mensaje).insertAfter("header");
	$(mensaje).show("fast");
}