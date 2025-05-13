
const $otpInputs = $('.otp-input');
const $verifyButton = $('#verifyButton');
$(document).ready(function () {
  $("#username").keypress(function (event) {
    if (event.keyCode == "13") {
      event.preventDefault();
      $("#password").focus();

    }
    
  })
  $("#password").keypress(function (event) {
    if (event.keyCode == "13") {
      event.preventDefault();
       $("#logBttn").click();
    }
  })


 
  $("#logBttn").click(function (event) {
    if ($("#username").val() == "" || $("#password").val() == "") {
        event.preventDefault();
        $(".logContainer__space").html("Vui lòng nhập đầy đủ thông tin.");
    } else {
        var mikExp = /[\$\\#^&*()\[\]+_{}\`~=!|\/?.:;\"\'@]/;
        if (mikExp.test($("#username").val()) || mikExp.test($("#password").val())) {
            event.preventDefault();
            $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
        } else {
            $.post("./Login/checkLoginAccount",
              {username: $("#username").val(), 
              password: $("#password").val()},
              function(data){  //AJAX không tải lại
              data =  JSON.parse(data);     //dữ liệu JSON
              if (data.status === 1) {
                localStorage.setItem('accessToken', data.token);
                window.location.href = '/Tax_Management/Home';
              } else {
                 $(".logContainer__space").html("Tên đăng nhập hoặc mật khẩu không đúng.");
              }              
          })
           
        }
    }
});

})
