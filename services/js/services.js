//overlay
function showOverlay() {
  document.getElementById("overlay").style.display = "block";
  document.body.style.overflow = "hidden";
}
function closeOverlay() {
  document.getElementById("overlay").style.display = "none";
  document.body.style.overflow = "visible";
}

// show data onclick
function showData(id) {
  let data = { data_id: id };
  $.ajax({
    type: "POST",
    url: "http://localhost/coolmaths/services/retrieve.php",
    data: JSON.stringify(data),
    dataType: "json",
    success: function (r) {
      let output = "";
      for (i = 0; i < r.length; ++i) {
        output +=
          "<div  data-aos='fade-up' data-aos-anchor-placement='bottom-bottom' data-aos-duration='3000' class='service-card'>" +
          "<img src='../services/" +
          r[i].img +
          "' alt='img'  />" +
          "<a href='" +
          r[i].link +
          "?classId=" +
          r[i].class_id +
          "'><center>" +
          "<h2 style='padding-top:10px'>" +
          r[i].name +
          "</h2></center></a></div>";
      }
      $("#service-content").html(output);
    },
    complete: function () {
      setTimeout(function () {
        messageScreen.style.display = "none";
      }, 1000);
    },
  });
}
// card hide and show on click
$(document).ready(function () {
  messageScreen = document.getElementById("message-screen");
  // change class of card on load
  var item = $(".active-item");
  defaultId = $(item).attr("data-cid");
  showData(defaultId);
  $(".item").on("click", function () {
    messageScreen.style.display = "flex";
    var items = $(".item");
    // Remove active-element class from navlinks
    for (let i = 0; i < items.length; i++) {
      items[i].classList.remove("active-item");
    }
    this.classList.add("active-item");
    let cid = $(this).attr("data-cid");
    showData(cid);
  });
});

// responsiveness
function display() {
  var block = document.getElementById("side-bar");
  const widthScreen = window.innerWidth;
  if (widthScreen > 900) {
    block.style.left = "0px";
  } else if (widthScreen <= 900) {
    block.style.left = "-250px";
  }
}

window.addEventListener("resize", display);

$(document).ready(function () {
  $("#toggle-button").on("click", function () {
    var side = document.getElementById("side-bar");
    side.style.transitionDuration = "0.5s";
    if (side.style.left == "0px") {
      side.style.left = "-250px";
    } else {
      side.style.left = "0px";
    }
  });
  AOS.init();
});
