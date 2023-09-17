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
// responiveness
function display() {
  var block = document.getElementById("side-bar");
  const widthScreen = window.innerWidth;
  if (widthScreen > 900) {
    block.style.left = "0px";
    closeOverlay();
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
  if (id == 4) {
    document.getElementById("4").querySelector(".form-header").innerHTML =
      "Upload Image<span class='close-form' onclick='closeForm(4)'>&times;</span>";
    var input = form.querySelectorAll("input");
    input[0].style.display = "inline-block";
    input[1].style.display = "inline-block";
  }
  if (id == 0) {
    document.getElementById("0").querySelector(".form-header").innerHTML =
      "Add Admins <span class='close-form' onclick='closeForm(0)'>&times;</span>";
  }
  if (id == 1) {
    document.getElementById("1").querySelector(".form-header").innerHTML =
      "Add members <span class='close-form' onclick='closeForm(1)'>&times;</span>";
  }
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
    for (i = 0; i <= 3; i++) {
      document.getElementById(i).style.display = "none";
      var form = document.getElementById(i).querySelector("form");

      if (i == 0) {
        document.getElementById("0").querySelector(".form-header").innerHTML =
          "Upload Topics <span class='close-form' onclick='closeForm(0)'>&times;</span>";
      }
      if (i == 1) {
        document.getElementById("1").querySelector(".form-header").innerHTML =
          "Upload Images <span class='close-form' onclick='closeForm(1)'>&times;</span>";
      }
      if (i == 2) {
        document.getElementById("2").querySelector(".form-header").innerHTML =
          "Upload Videos<span class='close-form' onclick='closeForm(2)'>&times;</span>";
      }
      $(form)[0].reset();
    }

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
  showClassData(defaultClassId, "topic");
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
    showClassData(cid, "topic");
    setTimeout(function () {
      var defaultTopicId = $(".active-row").attr("data-tid");
      showClassData(defaultTopicId, "image");
      showClassData(defaultTopicId, "video");
      showClassData(defaultTopicId, "pdf");
    }, 1000);
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

  $("#class-topic-tbody").on("click", ".topic-table-row", function () {
    var rows = $(".topic-table-row");
    // Remove active-element class from navlinks
    for (let i = 0; i < rows.length; i++) {
      rows[i].classList.remove("active-row");
    }
    this.classList.add("active-row");
    let tid = $(this).attr("data-tid");
    // alert("table row clicked" + tid);
    showClassData(tid, "image");
    showClassData(tid, "video");
    showClassData(tid, "pdf");
  });

  setTimeout(function () {
    var defaultTopicId = $(".active-row").attr("data-tid");
    showClassData(defaultTopicId, "image");
    showClassData(defaultTopicId, "video");
    showClassData(defaultTopicId, "pdf");
  }, 1000);
});

// show data
function showClassData(id, name) {
  error.style.display = "none";
  success.style.display = "none";
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
              "<tr class='topic-table-row active-row' data-tid=" +
              r[i].id +
              "><td>" +
              (i + 1) +
              "</td><td>" +
              r[i].topic +
              "</td>" +
              "<td><button class='edit' data-eid='" +
              r[i].id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          } else {
            output +=
              "<tr class='topic-table-row' data-tid='" +
              r[i].id +
              "'><td>" +
              (i + 1) +
              "</td><td>" +
              r[i].topic +
              "</td>" +
              "<td><button class='edit' data-eid='" +
              r[i].id +
              "'>Edit</button><button class='remove' data-did='" +
              r[i].id +
              "'>Remove</button></td></tr>";
          }
        }
        $("#class-topic-tbody").html(output);
      } else if (name.match("image")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            "<tr><td>" +
            (i + 1) +
            "</td><td><img class='image-preview' src='../coolmaths-classes/class-topic-images/" +
            r[i].img +
            "' alt='icon' onclick='fullScreenImage(this);'/></td><td>" +
            r[i].img +
            "</td><td><button class='remove' data-did='" +
            r[i].id +
            "'>Remove</button></td></tr>";
        }
        $("#class-image-tbody").html(output);
      } else if (name.match("video")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            "<tr><td>" +
            (i + 1) +
            "</td><td><iframe class='video-preview' src='" +
            r[i].link +
            "'></iframe></td><td>" +
            "<button class='remove' data-did='" +
            r[i].id +
            "'>Remove</button></td></tr>";
        }
        $("#class-video-tbody").html(output);
      } else if (name.match("pdf")) {
        for (i = 0; i < r.length; ++i) {
          output +=
            "<tr><td>" +
            (i + 1) +
            "</td><td><iframe src='http://localhost/coolmaths/coolmaths-classes/class-topic-pdfs/" +
            r[i].link +
            "' width='100%' height='500px' >" +
            "</iframe></td><td>" +
            r[i].link +
            "</td><td>" +
            "<button class='remove' data-did='" +
            r[i].id +
            "'>Remove</button></td></tr>";
        }
        $("#class-pdf-tbody").html(output);
      }
    },
    complete: function () {
      setTimeout(function () {
        messageScreen.style.display = "none";
      }, 1000);
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
            showClassData(class_id, uname);
          },
          complete: function () {
            setTimeout(function () {
              success.innerHTML = "";
              error.innerHTML = "";
            }, 2000);
          },
        });
      }
      e.stopImmediatePropagation();
    });
  }
  // form 0
  $("#add-class-topic-button").on("click", ".add", function () {
    uploadCounter = true;
    const classId = $(".active-element").attr("data-cid");
    let name = "topic";
    let formName = document.getElementById("class-topic-upload-form");
    var input = formName.querySelectorAll("input");
    input[0].value = classId;
    let btn = document.getElementById("upload-class-topic");
    uploadTableData(classId, name, formName, btn);
  });
  // form 1
  $("#add-topic-image-button").on("click", ".add", function () {
    uploadCounter = true;
    let topicId = $(".active-row").attr("data-tid");
    let name = "image";
    let formName = document.getElementById("topic-image-upload-form");
    var input = formName.querySelectorAll("input");
    input[0].value = topicId;
    let btn = document.getElementById("upload-topic-image");
    uploadTableData(topicId, name, formName, btn);
  });
  // form 2
  $("#add-topic-video-button").on("click", ".add", function () {
    uploadCounter = true;
    let topicId = $(".active-row").attr("data-tid");
    let name = "video";
    let formName = document.getElementById("topic-video-upload-form");
    var input = formName.querySelectorAll("input");
    input[0].value = topicId;
    let btn = document.getElementById("upload-topic-video");
    uploadTableData(topicId, name, formName, btn);
  });
  // form 3
  $("#add-topic-pdf-button").on("click", ".add", function () {
    uploadCounter = true;
    let topicId = $(".active-row").attr("data-tid");
    let name = "pdf";
    let formName = document.getElementById("topic-pdf-upload-form");
    var input = formName.querySelectorAll("input");
    input[0].value = topicId;
    let btn = document.getElementById("upload-topic-pdf");
    uploadTableData(topicId, name, formName, btn);
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

  // topic delete
  $("#class-topic-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("topic", data, mythis);
    }
  });
  // image delete
  $("#class-image-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("image", data, mythis);
    }
  });
  // video delete
  $("#class-video-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("video", data, mythis);
    }
  });
  // pdf delete
  $("#class-pdf-tbody").on("click", ".remove", function () {
    var mythis = this;
    if (confirm("Do you really want to delete this item?") == true) {
      let id = $(this).attr("data-did");
      let data = { data_id: id };
      deleteTableItems("pdf", data, mythis);
    }
  });

  // edit topic names

  function editTopic(ename, data) {
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
              "http://localhost/coolmaths/admin/other-update.php?name=up-" +
              upname,
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
              showClassData(ename);
            },
          });
        }
        e.stopImmediatePropagation();
      });
    }

    // displaying available data
    $.ajax({
      type: "POST",
      url: "http://localhost/coolmaths/admin/other-update.php?name=" + ename,
      data: JSON.stringify(data),
      dataType: "json",
      success: function (r) {
        var form = document.getElementById("class-topic-upload-form");
        var input = form.querySelectorAll("input");
        input[0].value = r.id;
        input[1].value = r.topic;
        let btn = document.getElementById("upload-class-topic");
        let divId = 0;
        showForm(divId);
        updateTableItems(ename, divId, form, btn);
      },
    });
  }
  $("#class-topic-tbody").on("click", ".edit", function () {
    uploadCounter = false;
    document.getElementById("0").querySelector(".form-header").innerHTML =
      "Update Topic <span class='close-form' onclick='closeForm(0)'>&times;</span>";
    let id = $(this).attr("data-eid");
    let data = { data_id: id };
    editTopic("topic", data);
  });
});
