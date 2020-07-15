var gallery = {
  show : function(img){
  // show() : show selected image in light box

    var clone = img.cloneNode(),
        front = document.getElementById("lfront"),
        back = document.getElementById("lback");

    front.innerHTML = "";
    front.appendChild(clone);
    back.classList.add("show");
  },

  hide : function(){
  // hide() : hide the lightbox

    document.getElementById("lback").classList.remove("show");
  }
};