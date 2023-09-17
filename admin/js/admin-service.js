let uploadCounter = true;
//overlay
function showOverlay() {
  document.getElementById("overlay").style.display = "flex";
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

// responiveness
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
});

//form slide down and up
function closeForm(id) {
  document.getElementById(id).style.display = "none";
  var form = document.getElementById(id).querySelector("form");
  $(form)[0].reset();
  closeOverlay();
}

function showForm(id) {
  document.getElementById(id).style.display = "block";
  showOverlay();
}

// fullscreen image
function fullScreenImage(img) {
  $("#image-display-container").slideDown();
  $("#full-screen-image").show(1000);
  // Get the expanded image
  var full = document.getElementById("full-screen-image");
  full.src = img.src;
  // Show the container element (hidden with CSS)
  document.body.style.overflow = "hidden";
  // full.parentElement.style.display = "block";
}

$(document).ready(function () {
  $("#overlay").on("click", function () {
    document.getElementById(0).style.display = "none";
    var form = document.getElementById(0).querySelector("form");
    $(form)[0].reset();
    closeLogoutForm();
    closeOverlay();
  });
});

// ONlY FOR CLASS PAGE

// card hide and show on click
$(document).ready(function () {
  messageScreen = document.getElementById("message-screen");
  loading = document.getElementById("loading");
  success = document.getElementById("success-message");
  error = document.getElementById("error-message");
  // change class of card on load
  var defaultClassId = $(".active-element").attr("data-cid");
  showserviceData(defaultClassId);
  $(".item").on("click", function () {
    messageScreen.style.display = "flex";
    loading.style.display = "block";
    var items = $(".item");
    // Remove active-element class from navlinks
    for (let i = 0; i < items.length; i++) {
      items[i].classList.remove("active-element");
    }
    this.classList.add("active-element");
    let cid = $(this).attr("data-cid");
    showserviceData(cid);
  });
});

// show data
function showserviceData(id) {
  let data = { data_id: id };
  $.ajax({
    type: "POST",
    url: "http://localhost/coolmaths/services/retrieve.php",
    data: JSON.stringify(data),
    dataType: "json",
    success: function (r) {
      let output = "";
      for (i = 0; i < r.length; ++i) {
        if (r[i].status == "inactive") {
          var style =
            "style='background-color:rgb(108, 114, 147);width:100px;'";
        } else {
          style = "style='width:100px;'";
        }
        output +=
          "<tr data-tid=" +
          r[i].id +
          "><td>" +
          (i + 1) +
          "</td><td><img class='image-preview' src='../services/" +
          r[i].img +
          "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
          r[i].name +
          "</td><td><button " +
          style +
          "class='edit' data-eid='" +
          r[i].id +
          "'>" +
          r[i].status +
          "</button></td><td><button class='remove' data-did='" +
          r[i].id +
          "'>Remove</button></td></tr>";
      }
      $("#services-tbody").html(output);
    },
    complete: function () {
      setTimeout(function () {
        messageScreen.style.display = "none";
      }, 2000);
    },
  });
}

$(document).ready(function () {
  // upload data
  function uploadTableData(class_id, uname, formName, btn) {
    $(formName).submit(function (e) {
      e.preventDefault();
      if (uploadCounter == true) {
        document.body.style.overflow = "hidden";
        messageScreen.style.display = "flex";
        loading.style.display = "block";
        btn.disabled = true;
        var formData = new FormData(this);
        $.ajax({
          type: "POST",
          url:
            "http://localhost/coolmaths/admin/other-upload.php?name=" + uname,
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            loading.style.display = "none";
            if (response == 1) {
              success.innerHTML = "Successfully Done...";
              error.style.display = "none";
              success.style.display = "block";
              let input = formName.querySelectorAll("input");
              input[1].value = null;
            } else {
              error.innerHTML = response;
              success.style.display = "none";
              error.style.display = "block";
            }
            btn.disabled = false;
            showserviceData(class_id);
          },
        });
      }
      e.stopImmediatePropagation();
    });
  }
  // form 0
  $("#add-services-button").on("click", ".add", function () {
    uploadCounter = true;
    const classId = $(".active-element").attr("data-cid");
    let name = "service";
    let formName = document.getElementById("service-upload-form");
    var input = formName.querySelectorAll("input");
    input[0].value = classId;
    let btn = document.getElementById("upload-service");
    uploadTableData(classId, name, formName, btn);
  });
});

// message screen fadeout on click
$(document).ready(function () {
  $("#list-of-classes").on("click", ".item", function () {});
  $("#message-screen").on("click", function () {
    $("#message-screen").fadeOut();
    $("#error-message").fadeOut();
    $("#success-message").fadeOut();
    $("#loading").fadeOut();
    document.body.style.overflow = "visible";
  });

  // remove topics

  function deleteTableItems(dname, data, mythis) {
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/other-remove.php?name=" + dname,
      data: JSON.stringify(data),
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          $(mythis).closest("tr").fadeOut();
          error.style.display = "none";
        } else {
          messageScreen.style.display = "flex";
          error.innerHTML = response;
          error.style.display = "block";
        }
      },
    });
  }
  $("#services-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("service", data, mythis);
    }
  });

  //change status values
  function changeStatusOfTableItems(sname, data) {
    messageScreen.style.display = "flex";
    loading.style.display = "block";
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/other-update.php?name=up-" + sname,
      data: JSON.stringify(data),
      success: function (response) {
        loading.style.display = "none";
        if (response == 1) {
          messageScreen.style.display = "none";
          const cid = $(".active-element").attr("data-cid");
          showserviceData(cid);
        } else {
          error.innerHTML = response;
          success.style.display = "none";
          error.style.display = "block";
        }
      },
      complete: function () {
        setTimeout(function () {
          messageScreen.style.display = "none";
          error.style.display = "none";
          success.style.display = "none";
        }, 1000);
      },
    });
  }
  // call to function
  $("#services-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    changeStatusOfTableItems("service", data);
  });
});
