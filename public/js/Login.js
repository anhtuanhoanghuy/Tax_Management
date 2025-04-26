
  function OpenModal(selectObject){
    var myModal = document.getElementById("loginMSTModal");
    var  modalInstance =  new bootstrap.Modal(myModal);
    console.log(myModal)

    console.log(modalInstance)
 modalInstance.show();
  }

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
      $("#email").focus();
    }
  })



    $('#confirmSendEmailModal').on('shown.bs.modal', function () {
      $('#sendEmailButton').focus();
    });



    $('#exampleModal').on('shown.bs.modal', function () {
      $('#otp-input1').focus();
    });
 
  $("#logBttn").click(function (event) { //xử lý đăng nhập
    if ($("#username").val() == "" || $("#password").val() == "" || $("#email").val() == "") {
      event.preventDefault();
      $(".logContainer__space").html("Vui lòng nhập đầy đủ thông tin.");
    } else if ($("#username").val() != "" && $("#password").val() != "" && $("#emailemail").val() != "") {
      var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
      if ($("#username").val().search(mikExp) >= 0 || $("#password").val().search(mikExp) >= 0 || validateContactInfo($("#email").val()) == false) {
        event.preventDefault();
        $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
      } else {
        $("#login").trigger("submit");
      }
    }
  })
})



// Validate OTP
$(document).ready(function() {
  const $otpInputs = $('.otp-input');
  const $verifyButton = $('#verifyOtpButton');

  $otpInputs.on('input', function() {
    if (this.value.length === parseInt($(this).attr('maxlength'))) {
      const index = $otpInputs.index(this);
      if (index < $otpInputs.length - 1) {
        $otpInputs.eq(index + 1).focus();
      } else {
        checkAllOtpFilled();
      }
    }
  });

  $otpInputs.on('keyup', function(event) {
    if (event.key === 'Backspace' && this.value.length === 0) {
      const index = $otpInputs.index(this);
      if (index > 0) {
        $otpInputs.eq(index - 1).focus();
      }
    }
  });

  function checkAllOtpFilled() {
    const allFilled = $otpInputs.toArray().every(input => input.value.length === parseInt($(input).attr('maxlength')));
    $verifyButton.prop('disabled', !allFilled);
  }

  // Gọi hàm kiểm tra ban đầu
  checkAllOtpFilled();
});
//

function validateContactInfo(inputText) {
  if(inputText.includes('@')) {
    validateEmail(inputText);
  } else if (inputText.startsWith('0') && !inputText.includes('@')) {
    validatePhoneNumber(inputText);
  } else {
    return false;
  }
}
 //Xử lý email
 function validateEmail(inputText){
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(inputText.match(mailformat)){
      console.log("email đúng");
  return true;}
  else {
      console.log("email không đúng định dạng");
  return false;}
  }
  
  //Xử lý sdt
  
  function validatePhoneNumber(mobile) {
      var vnf_regex = /((01|02|03|04|05|06|07|08|09)+([0-9]{8})\b)/g;
      if(mobile !==''){
          if (vnf_regex.test(mobile) == false) 
          {
              console.log('Số điện thoại không đúng định dạng!');
              return false
          }else{
              console.log('Số điện thoại của bạn hợp lệ!');
              return true;
          }
      }else{
          console.log('Bạn chưa điền số điện thoại!');
          return false
      }
  }