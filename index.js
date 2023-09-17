//reading mode
function readingMode() {
  var checkbox = document.getElementById("read");
  var nightmode = document.getElementById("readingMode");
  if (checkbox.checked == true) {
    nightmode.style.display = "block";
  } else nightmode.style.display = "none";
}

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

//admin login
function showAdminLoginForm() {
  document.getElementById("adminLoginForm").style.display = "block";
  document.getElementById("loginForm").style.display = "none";
}

function closeAdminLoginForm() {
  document.getElementById("adminLoginForm").style.display = "none";
  closeOverlay();
}

//login form
function showLoginForm() {
  document.getElementById("loginForm").style.display = "block";
  document.getElementById("adminLoginForm").style.display = "none";
  showOverlay();
}

function closeLoginForm() {
  document.getElementById("loginForm").style.display = "none";
  closeOverlay();
}

//forgot password
function showForgotPasswordForm() {
  document.getElementById("forgotPassword").style.display = "block";
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("adminLoginForm").style.display = "none";
}

function closeForgotPasswordForm() {
  document.getElementById("forgotPassword").style.display = "none";
  closeOverlay();
}
// reset password

function showResetPasswordForm() {
  document.getElementById("resetPassword").style.display = "block";
  document.getElementById("forgotPassword").style.display = "none";
}
function closeResetPasswordForm() {
  document.getElementById("resetPassword").style.display = "none";
  closeOverlay();
}
//window.onscroll = function() {()};

//signupform
function showSignUpForm() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("signupForm").style.display = "block";
}

function closeSignUpForm() {
  document.getElementById("signupForm").style.display = "none";
  closeOverlay();
}

// carousell
function carousel() {
  let slideIndex = 0;
  let slides = document.getElementById("slider");
  showSlides();

  function showSlides() {
    let i;
    let dots = document.getElementsByClassName("dot");
    slideIndex++;
    if (slideIndex > dots.length) {
      slideIndex = 1;
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides.style.transform = "translateX(-" + (slideIndex - 1) * 100 + "%)";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
  }
}

//hide classes
function hideMessages(msg, n) {
  document.getElementsByClassName(msg)[n].style.display = "none";
}

//show classes
function showMessages(msg, n) {
  document.getElementsByClassName(msg)[n].style.display = "block";
}

//show id
function showId(id) {
  document.getElementById(id).style.display = "block";
}

//hide id
function hideId(id) {
  document.getElementById(id).style.display = "none";
}

//

function getFocus(id) {
  document.getElementById(id).focus();
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
//AJAX

// function checkEmail() {
//   document.getElementById("registeredEmail").disabled = true;
//   var email = document.getElementById("registeredEmail").value;
//   var error = document.getElementsByClassName("error")[0];
//   var success = document.getElementsByClassName("success")[0];
//   document.getElementById("otpInput").style.display = "none";
//   document.getElementById("otpButton").style.display = "none";
//   error.style.display = "none";
//   success.style.display = "none";
//   error.innerHTML = null;
//   success.innerHTML = null;
//   data = { mail: email };
//   $.ajax({
//     type: "POST",
//     url: "http://localhost/coolmaths/security/forgotPassword.php?name=sendOTP",
//     data: JSON.stringify(data),
//     success: function (response) {
//       if (response == "1") {
//         document.getElementById("sendOtpButton").style.display = "none";
//         success.innerHTML = "Check your email for OTP...";
//         success.style.display = "block";
//         document.getElementById("otpInput").style.display = "inline-block";
//         document.getElementById("otpButton").style.display = "inline-block";
//         getFocus("otpInput");
//       } else {
//         document.getElementById("registeredEmail").disabled = false;
//         error.innerHTML = response;
//         error.style.display = "block";
//       }
//     },
//     complete: function () {
//       // document.getElementById("otpInput").style.display = "none";
//       // document.getElementById("otpButton").style.display = "none";
//       // error.style.display = "none";
//       // success.style.display = "none";
//       // error.innerHTML = null;
//       // success.innerHTML = null;
//     },
//   });
// }

// function checkOtp() {
//   var process = "OTP Check";
//   var OTP = document.getElementById("otpInput").value;
//   data = { otp: OTP };
//   $.ajax({
//     type: "POST",
//     url: "http://localhost/coolmaths/security/forgotPassword.php?name=checkOTP",
//     data: JSON.stringify(data),
//     success: function (response) {
//       if (response == "1") {
//       } else {
//         document.getElementById("registeredEmail").disabled = false;
//         error.innerHTML = response;
//         error.style.display = "block";
//       }
//     },
//     complete: function () {
//       document.getElementById("otpInput").style.display = "none";
//       document.getElementById("otpButton").style.display = "none";
//       error.style.display = "none";
//       success.style.display = "none";
//       error.innerHTML = null;
//       success.innerHTML = null;
//     },
//   });
// }

$(document).ready(function () {
  //fadeout messages
  setTimeout(function () {
    $(".error").hide();
  }, 3000);

  setTimeout(function () {
    $(".success").hide();
  }, 3000);
  AOS.init();
});
