
// function login() {
//     // Lấy giá trị từ các trường nhập liệu
//     var username = document.getElementById("username").value;
//     var password = document.getElementById("password").value;
//     var myModal = document.getElementById("loginModal");

//     var  modalInstance = bootstrap.Modal.getInstance(myModal);



// Kiểm tra tên người dùng và mật khẩu (thay thế bằng logic xác thực của riêng bạn)
//   if (username === "user" && password === "password") {
//     window.location="http://127.0.0.1:5500/index.html";

//     // Đăng nhập thành công
//     alert("Đăng nhập thành công");
//     // Chuyển hướng đến trang chủ hoặc trang sau khi đăng nhập
//       console.log("next")

//   } else {
//     // Đăng nhập thất bại
//   //   modalInstance.show()

//     alert("Tên người dùng hoặc mật khẩu không đúng.");
//   }
// }

//   function OpenModal(selectObject){
//     var myModal = document.getElementById("loginMSTModal");
//     var  modalInstance =  new bootstrap.Modal(myModal);
//     console.log(myModal)

//     console.log(modalInstance)
//  modalInstance.show();
//   }

$(document).ready(function () {
  $("#username").keypress(function (event) {
    if (event.keyCode == "13") {
      event.preventDefault();
      $("#password").focus();

    }
  })

  $("#logBttn").click(function (event) { //xử lý đăng nhập
      $(".otp-Form").prop("display","flex");
    // if ($("#username").val() == "" && $("#password").val() == "") {
    //   event.preventDefault();
    //   $(".logContainer__space").html("Vui lòng nhập tên đăng nhập và mật khẩu.");
    // } else if ($("#username").val() == "" && $("#password").val() != "") {
    //   event.preventDefault();
    //   $(".logContainer__space").html("Vui lòng nhập tên đăng nhập.");
    // } else if ($("#username").val() != "" && $("#password").val() == "") {
    //   event.preventDefault();
    //   $(".logContainer__space").html("Vui lòng nhập mật khẩu.");
    // } else {
    //   var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
    //   if ($("#username").val().search(mikExp) >= 0 || $("#password").val().search(mikExp) >= 0) {
    //     event.preventDefault();
    //     $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
    //   } else if (($("#username").val() == "user" && $("#password").val() == "password")) {
    //     alert("hi")
    //     window.location = "http://127.0.0.1:5500/index.html";
    //   } else {
    //     $("#login").trigger("submit");
    //   }
    // }
  })
})