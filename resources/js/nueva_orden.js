addLoadEvent(function() {
    document.getElementById("selector_de_productos").addEventListener("change", function() {
        document.getElementById("modal_producto_titulo").innerHTML = this.children[0].value;
        document.getElementById("modal_producto").classList.add("active");
    });
    document.getElementById("cerrar_modal_producto").addEventListener("click", function() {
        document.getElementById("modal_producto").classList.remove("active");
        var options = document.querySelectorAll('#selector_de_productos option');
        for (var i = 0, l = options.length; i < l; i++) {
            options[i].selected = options[i].defaultSelected;
        }
    });
    document.getElementById("fecha-slider").addEventListener("input", function() {
        this.setAttribute('value', this.value);
        this.setAttribute('data-tooltip', document.getElementById('tickmarks').childNodes[this.value].value);
        var fecha = document.getElementById("fecha");
        switch (this.value) {
            case "1":
                fecha.value = getFecha(this.value);
                break;
            case "2":
                fecha.value = getFecha(this.value);
                break;
            case "3":
                fecha.value = getFecha(this.value);
                fecha.classList.remove("d-none");
                this.classList.add("d-none")
                break;
        }
    });
    document.getElementById("cantidad-slider").addEventListener("input", function() {
        var cantidad = document.getElementById("cantidad");
        cantidad.setAttribute('value', this.value);
        if (this.value == 10) {
            cantidad.classList.remove("d-none");
            this.classList.add("d-none")
        }
    });
    document.querySelectorAll('.panel-body')[0].innerHTML += 
    "<div class='tile tile-centered'>\
      <div class='tile-content'>\
        <div class='tile-title'>COCACOLA</div>\
        <div class='tile-subtitle text-gray'>Cant: 3 | Desc: 0%</div>\
      </div>\
      <div class='tile-action'>\
        <button class='btn btn-link'>\
          <i class='icon icon-edit'></i>\
        </button>\
      </div>\
    </div>"
});