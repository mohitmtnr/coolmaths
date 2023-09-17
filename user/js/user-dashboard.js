//overlay
function showOverlay() {
  document.getElementById("overlay").style.display = "block";
  document.body.style.overflow = "hidden";
}
function closeOverlay() {
  document.getElementById("overlay").style.display = "none";
  document.body.style.overflow = "visible";
}
//logout form
function showLogoutForm() {
  document.getElementById("logoutForm").style.display = "block";
  showOverlay();
}

function closeLogoutForm() {
  document.getElementById("logoutForm").style.display = "none";
  closeOverlay();
}

// card hide and show on click
$(document).ready(function () {
  $(".item").on("click", function () {
    var items = $(".item");
    var cards = $(".card");
    // Remove active-element class from navlinks
    for (let i = 0; i < items.length; i++) {
      items[i].classList.remove("active-element");
      cards[i].classList.remove("active-card");
    }
    this.classList.add("active-element");
    // get the value of item's index
    var j = Array.from(items).indexOf(this);
    cards[j].classList.add("active-card");
  });
});

function display() {
  var block = document.getElementById("left");
  console.log(block);
  const widthScreen = window.innerWidth;
  console.log(widthScreen);
  if (widthScreen > 800) {
    block.style.width = "15%";
  } else if (widthScreen <= 800) {
    block.style.width = "0px";
  }
}

window.addEventListener("resize", display);

$(document).ready(function () {
  $("#toggle-button").click(function () {
    document.getElementById("toggle-button").classList.toggle("active");
    $("#toggle-menu").toggle("slow");
  });
});
