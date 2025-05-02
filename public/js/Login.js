
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
      $("#email").focus();
    }
  })


 
  $("#logBttn").click(function (event) {
    if ($("#username").val() == "" || $("#password").val() == "" || $("#email").val() == "") {
        event.preventDefault();
        $(".logContainer__space").html("Vui lòng nhập đầy đủ thông tin.");
    } else {
        var mikExp = /[\$\\#^&*()\[\]+_{}\`~=!|\/?.:;\"\'@]/;
        if (mikExp.test($("#username").val()) || mikExp.test($("#password").val()) || !validateContactInfo($("#email").val())) {
            event.preventDefault();
            $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
        } else {
            $("#login").trigger("submit");
          //   $.post("./Login/checkLoginAccount",
          //     {username: $("#username").val(), 
          //     password: $("#password").val(),
          //     email: $("#email").val()},
          //     function(data){  //AJAX không tải lại
          //     // data =  JSON.parse(data);     //dữ liệu JSON
          //     console.log(data);
              
          // })
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
            $('#exampleModal').on('shown.bs.modal', function () {
              $('#otp-input1').focus();
            });
          
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
          
          
          
            // Gọi hàm kiểm tra ban đầu
            checkAllOtpFilled();
        }
    }
});


  // $('#confirmSendEmailModal').on('shown.bs.modal', function () {
  //   $('#sendEmailButton').focus();
  // });




})


function checkAllOtpFilled() {
  const allFilled = $otpInputs.toArray().every(input => input.value.length === parseInt($(input).attr('maxlength')));
  $verifyButton.prop('disabled', !allFilled);
}

function validateContactInfo(inputText) {
  if(inputText.includes('@')) {
    return validateEmail(inputText);
  } else if (inputText.startsWith('0') && !inputText.includes('@')) {
    return validatePhoneNumber(inputText);
  } else {
    return false;
  }
}
 //Xử lý email
 function validateEmail(inputText) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!inputText) {
        return { valid: false, error: "Vui lòng nhập email." };
    }

    if (!emailRegex.test(inputText)) {
        return { valid: false, error: "Email không đúng định dạng." };
    }

    return { valid: true, error: "" };
}
  //Xử lý sdt
  
  function validatePhoneNumber(mobile) {
    // Regex: đầu 03, 05, 07, 08, 09 + 8 số
    var vnf_regex = /^(0[3|5|7|8|9])[0-9]{8}$/;
    if (!mobile) {
        return false;
    }
    if (!vnf_regex.test(mobile)) {
        return false;
    }
    return true;
}

  function OpenModal(selectObject){
    var myModal = document.getElementById("loginMSTModal");
    var  modalInstance =  new bootstrap.Modal(myModal);
    console.log(myModal)

    console.log(modalInstance)
 modalInstance.show();
  }
