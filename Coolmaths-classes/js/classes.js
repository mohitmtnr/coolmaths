//overlay
function showOverlay() {
  document.getElementById("overlay").style.display = "block";
  document.body.style.overflow = "hidden";
}
function closeOverlay() {
  document.getElementById("overlay").style.display = "none";
  document.body.style.overflow = "visible";
}
//reading mode
function readingMode() {
  var checkbox = document.getElementById("read");
  var nightmode = document.getElementById("readingMode");
  if (checkbox.checked == true) {
    nightmode.style.display = "block";
  } else nightmode.style.display = "none";
}
// show data onclick
function showData(id, name) {
  let data = { data_id: id };
  $.ajax({
    type: "POST",
    url:
      "http://localhost/coolmaths/coolmaths-classes/retrieve.php?name=" + name,
    data: JSON.stringify(data),
    dataType: "json",
    success: function (r) {
      let output = "";
      if (name.match("topic")) {
        for (i = 0; i < r.length; ++i) {
          if (i == 0) {
            output +=
              "<tr data-aos='fade-up' data-aos-anchor-placement='bottom-bottom' data-aos-duration='3000' class='topic-table-row active-row' data-tid='" +
              r[i].id +
              "'><td>" +
              (i + 1) +
              "</td><td>" +
              r[i].topic +
              "</td></tr>";
          } else {
            output +=
              "<tr data-aos='fade-up' data-aos-anchor-placement='bottom-bottom' data-aos-duration='3000' class='topic-table-row' data-tid='" +
              r[i].id +
              "'><td>" +
              (i + 1) +
              "</td><td>" +
              r[i].topic +
              "</td></tr>";
          }
        }
        $("#class-tbody").html(output);
      } else if (name.match("image")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            " <div class='swiper-slide'><img src='class-topic-images/" +
            r[i].img +
            "' alt='image'></div>";
        }
        $("#topic-image-swiper").html(output);
      } else if (name.match("video")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            "<div class='swiper-slide'><iframe src='" +
            r[i].link +
            "'  allowfullscreen></iframe></div>";
        }
        $("#topic-video-swiper").html(output);
      } else if (name.match("pdf")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            "<iframe  src='http://localhost/coolmaths/coolmaths-classes/class-topic-pdfs/" +
            r[i].link +
            "' allowfullscreen>" +
            "</iframe>";
        }
        $("#class-topic-pdf").html(output);
      }
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
  showData(defaultId, "topic");
  $(".item").on("click", function () {
    messageScreen.style.display = "flex";
    var items = $(".item");
    // Remove active-element class from navlinks
    for (let i = 0; i < items.length; i++) {
      items[i].classList.remove("active-item");
    }
    this.classList.add("active-item");
    let cid = $(this).attr("data-cid");
    showData(cid, "topic");
    setTimeout(function () {
      var defaultTopicId = $(".active-row").attr("data-tid");
      showData(defaultTopicId, "image");
      showData(defaultTopicId, "video");
      showData(defaultTopicId, "pdf");
    }, 1000);
  });

  $("#class-tbody").on("click", ".topic-table-row", function () {
    messageScreen.style.display = "flex";
    var rows = $(".topic-table-row");
    // Remove active-element class from navlinks
    for (let i = 0; i < rows.length; i++) {
      rows[i].classList.remove("active-row");
    }
    this.classList.add("active-row");
    let tid = $(this).attr("data-tid");
    // alert("table row clicked" + tid);
    showData(tid, "image");
    showData(tid, "video");
    showData(tid, "pdf");
  });

  $(".section").on("click", function () {
    var sections = $(".section");
    // Remove active-element class from navlinks
    for (let i = 0; i < sections.length; i++) {
      sections[i].classList.remove("active-section");
    }
    this.classList.add("active-section");
    $(".image")[0].classList.remove("active-card");
    $(".video")[0].classList.remove("active-card");
    $(".pdf")[0].classList.remove("active-card");
    var j = Array.from(sections).indexOf(this);
    if (j == 0) {
      $(".image")[0].classList.add("active-card");
    } else if (j == 1) {
      $(".video")[0].classList.add("active-card");
    } else if (j == 2) {
      $(".pdf")[0].classList.add("active-card");
    }
  });

  setTimeout(function () {
    var defaultTopicId = $(".active-row").attr("data-tid");
    showData(defaultTopicId, "image");
    showData(defaultTopicId, "video");
    showData(defaultTopicId, "pdf");
  }, 1000);
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
