
// var captchaKey;
// var token;
// function getCaptcha() {
//   $.get("https://hoadondientu.gdt.gov.vn:30000/captcha", function (data, status) {
//     captchaKey = data.key;
//     console.log(data.key);
//     $("#captcha").empty();
//     $("#captcha").append(data.content)
//   });

// }

// function OpenModal(selectObject) {
//   var myModal = document.getElementById("loginMSTModal");

//   var modalInstance = new bootstrap.Modal(myModal);
//   console.log(myModal)

//   console.log(modalInstance)
//   modalInstance.show();
//   getCaptcha();
// }


// function loginMST(selectObject) {

//   // Lấy giá trị từ các trường nhập liệu
//   var mst = document.getElementById("mst").value;
//   var passwordMST = document.getElementById("passwordMST").value;




//   // Kiểm tra tên người dùng và mật khẩu (thay thế bằng logic xác thực của riêng bạn)
//   if (mst === "user" && passwordMST === "password") {


//     // Đăng nhập thành công
//     alert("Đăng nhập thành công!");
//     // Chuyển hướng đến trang chủ hoặc trang sau khi đăng nhập

//     console.log(modalInstance)
//     modalInstance.hide()
//   } else {
//     // Đăng nhập thất bại
//     //   modalInstance.show()

//     alert("Tên người dùng hoặc mật khẩu không đúng.");
//   }
// }

// document.getElementById("selectCompany").addEventListener("change", function () {

//   var selectedValue = this.value;
//   OpenModal(selectedValue)

// })
// $("#loginCompany").click(function () {
//   $.post({
//     url: "https://hoadondientu.gdt.gov.vn:30000/security-taxpayer/authenticate",
//     contentType: "application/json",  // Đặt đúng kiểu dữ liệu
//     data: JSON.stringify({
//       ckey: captchaKey,
//       cvalue: $("#captchaValue").val(),
//       password: $("#passwordMST").val(),
//       username: $("#mst").val()
//     }),
//     success: function (response) {
//       token = response.token;
//       console.log(token);

//     },
//     error: function (xhr) {
//       getCaptcha();
//       console.log("Error:", xhr.responseText);

//     }
//   });

// })

// $(".bi-bell").click(function () {
//   $.get({
//     url: "https://hoadondientu.gdt.gov.vn:30000/query/invoices/sold",
//     data: {
//       sort: "tdlap:desc,khmshdon:asc,shdon:desc",
//       size: "15",
//       search: "tdlap=ge=02/03/2025T00:00:00;tdlap=le=01/04/2025T23:59:59"
//     },
//     headers: {
//       "Authorization": "Bearer " + token  // Thêm Authorization vào header
//     },
//     success: function (response) {
//       console.log("Response:", response);
//     },
//     error: function (xhr) {
//       console.log("Error:", xhr.responseText);

//     }
//   });
// });

// $(document).ready(function(){
//   $("#username").keypress(function(event) {
//       if (event.keyCode == "13") {
//           event.preventDefault();
//           $("#password").focus();
          
//       }
//   })

//   $("#logbttn").click(function(event) { //xử lý đăng nhập
//       if ($("#username").val() == "" && $("#password").val() == "") {
//           event.preventDefault();
//           $(".logContainer__space").html("Vui lòng nhập tên đăng nhập và mật khẩu.");
//       } else if ($("#username").val() == "" && $("#password").val() != "") {
//           event.preventDefault();
//           $(".logContainer__space").html("Vui lòng nhập tên đăng nhập.");
//       } else if ($("#username").val() != "" && $("#password").val() == "") {
//           event.preventDefault();
//           $(".logContainer__space").html("Vui lòng nhập mật khẩu.");
//       } else {
//           var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
//           if ($("#username").val().search(mikExp) >= 0 || $("#password").val().search(mikExp) >= 0) {
//               event.preventDefault();
//               $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
//           } else {
//               $("#login").trigger( "submit" );
//           }

//       }
//   })
// })