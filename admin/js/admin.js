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
//upload

$(document).ready(function () {
  // form handling
  let error = document.getElementById("error-message");
  let success = document.getElementById("success-message");
  let messageScreen = document.getElementById("message-screen");
  var loading = document.getElementById("loading");
  // show data
  function showData(name) {
    let output = "";
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/retrieve.php?name=" + name,
      dataType: "json",
      success: function (r) {
        if (name.match("admin")) {
          for (i = 0; i < r.length; ++i) {
            output +=
              "<tr><td>" +
              r[i].id +
              "</td><td><img class='image-preview' src='../user-profile/" +
              r[i].img +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].username +
              "</td><td>" +
              r[i].email +
              "</td><td>" +
              r[i].mobile +
              "</td><td>" +
              r[i].status +
              "</td>" +
              "<td><button class='edit' data-eid='" +
              r[i].id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          }
          $("#admin-tbody").html(output);
        } else if (name.match("member")) {
          for (i = 0; i < r.length; ++i) {
            output +=
              "<tr><td>" +
              r[i].id +
              "</td><td><img class='image-preview' src='../user-profile/" +
              r[i].img +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].username +
              "</td><td>" +
              r[i].email +
              "</td><td>" +
              r[i].mobile +
              "</td><td>" +
              r[i].class_id +
              "</td><td>" +
              r[i].status +
              "</td>" +
              "<td><button class='edit' data-eid='" +
              r[i].id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          }
          $("#member-tbody").html(output);
        } else if (name.match("icon")) {
          for (i = 0; i < r.length; ++i) {
            if (r[i].status == "inactive") {
              var style =
                "style='background-color:rgb(108, 114, 147);width:100px;'";
            } else {
              style = "style='width:100px;'";
            }
            output +=
              "<tr><td>" +
              r[i].icon_id +
              "</td><td><img class='image-preview' src='../coolmaths-icon/" +
              r[i].icon_name +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].icon_name +
              "<td><button " +
              style +
              "class='edit' data-eid='" +
              r[i].icon_id +
              "'>" +
              r[i].status +
              "</button></td><td><button class='remove' data-did='" +
              r[i].icon_id +
              "'>Remove</button></td></tr>";
          }
          $("#icon-tbody").html(output);
        } else if (name.match("carousel")) {
          for (i = 0; i < r.length; ++i) {
            if (r[i].status == "inactive") {
              var style =
                "style='background-color:rgb(108, 114, 147);width:100px;'";
            } else {
              style = "style='width:100px;'";
            }
            output +=
              "<tr><td>" +
              r[i].id +
              "</td><td><img class='image-preview' src='../carousel-images/" +
              r[i].img +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].img +
              "<td><button " +
              style +
              "class='edit' data-eid='" +
              r[i].id +
              "'>" +
              r[i].status +
              "</button></td><td><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          }
          $("#carousel-tbody").html(output);
        } else if (name.match("gallery")) {
          for (i = 0; i < r.length; ++i) {
            output +=
              "<tr><td>" +
              r[i].img_id +
              "</td><td><img class='image-preview' src='../gallery-images/" +
              r[i].img_name +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].img_name +
              "</td><td><button class='edit' data-eid='" +
              r[i].img_id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].img_id +
              "'>Remove</button></td></tr>";
          }
          $("#gallery-tbody").html(output);
        } else if (name.match("class")) {
          for (i = 0; i < r.length; ++i) {
            output +=
              "<tr><td>" +
              r[i].id +
              "</td><td><img class='image-preview' src='../coolmaths-classes/" +
              r[i].img +
              "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
              r[i].img +
              "</td><td>" +
              r[i].class +
              "</td><td><button class='edit' data-eid='" +
              r[i].id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          }
          $("#class-tbody").html(output);
        }
      },
    });
  }
  showData("admin");
  showData("member");
  showData("icon");
  showData("carousel");
  showData("gallery");
  showData("class");

  // upload data
  function uploadTableData(uname, formName, btn) {
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
          url: "http://localhost/coolmaths/admin/upload.php?name=" + uname,
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            loading.style.display = "none";
            if (response == 1) {
              success.innerHTML = "Successfully Done...";
              error.style.display = "none";
              success.style.display = "block";
              $(formName)[0].reset();
            } else {
              error.innerHTML = response;
              success.style.display = "none";
              error.style.display = "block";
            }
            btn.disabled = false;
            showData(uname);
          },
          // complete: function () {
          //   setTimeout(function () {
          //     document.body.style.overflow = "visible";
          //     messageScreen.style.display = "none";
          //     error.style.display = "none";
          //     success.style.display = "none";
          //   }, 2000);
          // },
        });
      }
      e.stopImmediatePropagation();
    });
  }
  // form 0
  $("#add-admin-button").on("click", ".add", function () {
    uploadCounter = true;
    let name = "admin";
    let formName = document.getElementById("upload-admins-details-form");
    let btn = document.getElementById("upload-admins");
    uploadTableData(name, formName, btn);
  });
  // form 1
  $("#add-member-button").on("click", ".add", function () {
    uploadCounter = true;
    let name = "member";
    let formName = document.getElementById("upload-members-details-form");
    let btn = document.getElementById("upload-members");
    uploadTableData(name, formName, btn);
  });
  // form 2
  $("#add-icon-button").on("click", ".add", function () {
    uploadCounter = true;
    let name = "icon";
    let formName = document.getElementById("icon-upload-form");
    let btn = document.getElementById("upload-icon");
    uploadTableData(name, formName, btn);
  });
  // form 3
  $("#add-carousel-image-button").on("click", ".add", function () {
    uploadCounter = true;
    let name = "carousel";
    let formName = document.getElementById("carousel-image-upload-form");
    let btn = document.getElementById("upload-carousel-image");
    uploadTableData(name, formName, btn);
  });
  // form 4
  $("#add-gallery-image-button").on("click", ".add", function () {
    uploadCounter = true;
    var form = document.getElementById("4").querySelector("form");
    var input = form.querySelectorAll("input");
    input[0].style.display = "none";
    input[2].style.display = "none";
    input[0].removeAttribute("required");
    input[2].removeAttribute("required");
    let name = "gallery";
    let formName = document.getElementById("gallery-image-upload-form");
    let btn = document.getElementById("upload-gallery-image");
    uploadTableData(name, formName, btn);
  });
  // form 5
  $("#add-class-button").on("click", ".add", function () {
    uploadCounter = true;
    var form = document.getElementById("5").querySelector("form");
    let name = "class";
    let formName = document.getElementById("upload-class-details-form");
    let btn = document.getElementById("upload-class");
    uploadTableData(name, formName, btn);
  });
  // form handling ends
  // table content delete
  function deleteTableItems(dname, data, mythis) {
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/remove.php?name=" + dname,
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
  // admin delete
  $("#admin-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("admin", data, mythis);
    }
  });
  // member delete
  $("#member-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("member", data, mythis);
    }
  });
  // icon delete
  $("#icon-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("icon", data, mythis);
    }
  });
  // carousel delete
  $("#carousel-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("carousel", data, mythis);
    }
  });
  // gallery delete
  $("#gallery-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("gallery", data, mythis);
    }
  });
  // class delete
  $("#class-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("class", data, mythis);
    }
  });

  // table content delete
  // table content edit
  function editTableItems(ename, data) {
    // update table item
    function updateTableItems(upname, divId, formName, btn) {
      $(formName).submit(function (e) {
        e.preventDefault();
        if (uploadCounter == false) {
          document.body.style.overflow = "hidden";
          messageScreen.style.display = "flex";
          loading.style.display = "block";
          btn.disabled = true;
          var formData = new FormData(this);
          $.ajax({
            type: "POST",
            url:
              "http://localhost/coolmaths/admin/update.php?name=up-" + upname,
            data: formData,
            contentType: false, // or multipart/form-data
            processData: false,
            success: function (response) {
              loading.style.display = "none";
              if (response == 1) {
                success.innerHTML = "Successfully Updated...";
                error.style.display = "none";
                success.style.display = "block";
                closeForm(divId);
              } else {
                error.innerHTML = response;
                success.style.display = "none";
                error.style.display = "block";
              }
              btn.disabled = false;
              showData(upname);
            },
            // complete: function () {
            //   setTimeout(function () {
            //     document.body.style.overflow = "visible";
            //     messageScreen.style.display = "none";
            //     error.style.display = "none";
            //     success.style.display = "none";
            //   }, 2000);
            // },
          });
        }
        e.stopImmediatePropagation();
      });
    }

    // displaying available data
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/update.php?name=" + ename,
      data: JSON.stringify(data),
      dataType: "json",
      success: function (r) {
        if (ename.match("admin")) {
          var form = document.getElementById("upload-admins-details-form");
          var input = form.querySelectorAll("input");
          var icon = form.querySelectorAll("i");
          input[0].value = r.id;
          input[0].readOnly = true;
          input[1].value = r.username;
          input[2].value = r.designation;
          input[3].value = r.email;
          input[4].value = r.mobile;
          input[5].style.display = "none";
          input[6].style.display = "none";
          icon[5].style.display = "none";
          icon[6].style.display = "none";
          input[5].removeAttribute("required");
          input[6].removeAttribute("required");
          form.querySelector("select").value = r.status;
          let btn = document.getElementById("upload-admins");
          let divId = 0;
          showForm(divId);
          updateTableItems(ename, divId, form, btn);
        } else if (ename.match("member")) {
          var form = document.getElementById("upload-members-details-form");
          var input = form.querySelectorAll("input");
          var icon = form.querySelectorAll("i");
          input[0].value = r.id;
          input[0].readOnly = true;
          input[1].value = r.username;
          input[2].value = r.email;
          input[3].value = r.mobile;
          input[4].style.display = "none";
          input[5].style.display = "none";
          icon[4].style.display = "none";
          icon[5].style.display = "none";
          input[4].removeAttribute("required");
          input[5].removeAttribute("required");
          form.querySelector("select").value = r.status;
          input[6].value = r.class_id;
          let btn = document.getElementById("upload-members");
          let divId = 1;
          showForm(divId);
          updateTableItems(ename, divId, form, btn);
        } else if (ename.match("gallery")) {
          var form = document.getElementById("gallery-image-upload-form");
          var input = form.querySelectorAll("input");
          input[1].style.display = "none";
          input[1].removeAttribute("required");
          input[0].setAttribute("required", "");
          input[2].style.display = "inline-block";
          input[0].style.display = "inline-block";
          input[0].value = r.img_id;
          input[2].value = r.about_img;
          let btn = document.getElementById("upload-gallery-image");
          let divId = 4;
          showForm(divId);
          updateTableItems(ename, divId, form, btn);
        } else if (ename.match("class")) {
          var form = document.getElementById("upload-class-details-form");
          var input = form.querySelectorAll("input");
          input[0].value = r.id;
          input[0].readOnly = true;
          input[1].value = r.class;
          input[2].value = r.content;
          input[3].style.display = "none";
          input[3].removeAttribute("required");
          let btn = document.getElementById("upload-class");
          let divId = 5;
          showForm(divId);
          updateTableItems(ename, divId, form, btn);
        }
      },
    });
  }
  $("#admin-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    document.getElementById("0").querySelector(".form-header").innerHTML =
      "Update Admins <span class='close-form' onclick='closeForm(0)'>&times;</span>";
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    editTableItems("admin", data);
  });
  $("#member-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    document.getElementById("1").querySelector(".form-header").innerHTML =
      "Update Members <span class='close-form' onclick='closeForm(1)'>&times;</span>";
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    editTableItems("member", data);
  });
  $("#gallery-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    document.getElementById("4").querySelector(".form-header").innerHTML =
      "Edit Content About Image <span class='close-form' onclick='closeForm(4)'>&times;</span>";
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    editTableItems("gallery", data);
  });
  $("#class-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    document.getElementById("5").querySelector(".form-header").innerHTML =
      "Update Class <span class='close-form' onclick='closeForm(5)'>&times;</span>";
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    editTableItems("class", data);
  });
  //change status values
  function changeStatusOfTableItems(sname, data) {
    messageScreen.style.display = "flex";
    loading.style.display = "block";
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/update.php?name=up-" + sname,
      data: JSON.stringify(data),
      success: function (response) {
        loading.style.display = "none";
        if (response == 1) {
          messageScreen.style.display = "none";
          showData(sname);
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
  $("#icon-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    changeStatusOfTableItems("icon", data);
  });
  $("#carousel-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    changeStatusOfTableItems("carousel", data);
  });
});

//form slide down and up
function closeForm(id) {
  document.getElementById(id).style.display = "none";
  var form = document.getElementById(id).querySelector("form");
  if (id == 4) {
    document.getElementById("4").querySelector(".form-header").innerHTML =
      "Upload Image<span class='close-form' onclick='closeForm(4)'>&times;</span>";
    var input = form.querySelectorAll("input");
    input[0].setAttribute("required", "");
    input[1].style.display = "inline-block";
  }
  if (id == 0) {
    document.getElementById("0").querySelector(".form-header").innerHTML =
      "Add Admins <span class='close-form' onclick='closeForm(0)'>&times;</span>";
    var input = form.querySelectorAll("input");
    var icon = form.querySelectorAll("i");
    input[0].readOnly = false;
    input[5].style.display = "inline-block";
    input[6].style.display = "inline-block";
    icon[5].style.display = "inline-block";
    icon[6].style.display = "inline-block";
    input[5].setAttribute("required", "");
    input[6].setAttribute("required", "");
  }
  if (id == 1) {
    document.getElementById("1").querySelector(".form-header").innerHTML =
      "Add Members <span class='close-form' onclick='closeForm(1)'>&times;</span>";
    var input = form.querySelectorAll("input");
    var icon = form.querySelectorAll("i");
    input[0].readOnly = false;
    input[4].style.display = "inline-block";
    input[5].style.display = "inline-block";
    icon[4].style.display = "inline-block";
    icon[5].style.display = "inline-block";
    input[4].setAttribute("required", "");
    input[5].setAttribute("required", "");
  }

  if (id == 5) {
    document.getElementById("5").querySelector(".form-header").innerHTML =
      "Add Class <span class='close-form' onclick='closeForm(5)'>&times;</span>";
    var input = form.querySelectorAll("input");
    input[0].readOnly = false;
    input[3].style.display = "inline-block";
    input[3].setAttribute("required", "");
  }
  $(form)[0].reset();
  closeOverlay();
}

function showForm(id) {
  document.getElementById(id).style.display = "block";
  showOverlay();
}

$(document).ready(function () {
  $("#overlay").on("click", function () {
    for (i = 0; i <= 5; i++) {
      document.getElementById(i).style.display = "none";
      var form = document.getElementById(i).querySelector("form");
      if (i == 4) {
        document.getElementById("4").querySelector(".form-header").innerHTML =
          "Upload Image<span class='close-form' onclick='closeForm(4)'>&times;</span>";
        var input = form.querySelectorAll("input");
        input[0].setAttribute("required", "");
        input[1].style.display = "inline-block";
      }
      if (i == 0) {
        document.getElementById("0").querySelector(".form-header").innerHTML =
          "Add Admins <span class='close-form' onclick='closeForm(0)'>&times;</span>";
        var input = form.querySelectorAll("input");
        var icon = form.querySelectorAll("i");
        input[0].readOnly = false;
        input[5].style.display = "inline-block";
        input[6].style.display = "inline-block";
        icon[5].style.display = "inline-block";
        icon[6].style.display = "inline-block";
        input[5].setAttribute("required", "");
        input[6].setAttribute("required", "");
      }
      if (i == 1) {
        document.getElementById("1").querySelector(".form-header").innerHTML =
          "Add members <span class='close-form' onclick='closeForm(1)'>&times;</span>";
        var input = form.querySelectorAll("input");
        var icon = form.querySelectorAll("i");
        input[0].readOnly = false;
        input[4].style.display = "inline-block";
        input[5].style.display = "inline-block";
        icon[4].style.display = "inline-block";
        icon[5].style.display = "inline-block";
        input[4].setAttribute("required", "");
        input[5].setAttribute("required", "");
      }
      if (i == 5) {
        document.getElementById("5").querySelector(".form-header").innerHTML =
          "Add Class <span class='close-form' onclick='closeForm(5)'>&times;</span>";
        var input = form.querySelectorAll("input");
        input[0].readOnly = false;
        input[3].style.display = "inline-block";
        input[3].setAttribute("required", "");
      }
      $(form)[0].reset();
    }
    closeLogoutForm();
    closeOverlay();
  });
});

$(document).ready(function () {
  $("#message-screen").on("click", function () {
    $("#message-screen").fadeOut();
    $("#error-message").fadeOut();
    $("#success-message").fadeOut();
    $("#loading").fadeOut();
    document.body.style.overflow = "visible";
  });
});
