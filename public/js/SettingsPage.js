var old_mst_input = "";
var old_email ="";
var old_tel ="";
$(document).ready(function(){
    $.post("./Settings/getAccountInfo", //AJAX không tải lại
        {username: "tuan",
        token: "12345678"
        },function(data){
            data =  JSON.parse(data); //dữ liệu JSON
            if (data.length > 0) {
                $("#newEmail").val(data[0].email);
                $("#newPhone").val(data[0].tel);
                old_email = data[0].email;
                old_tel = data[0].tel;
            }
    
        }) 
    $.post("./Settings/getCompanyList", //AJAX không tải lại
        {username: "tuan",
        token: "12345678"
        },function(data){
            data =  JSON.parse(data); //dữ liệu JSON
            if (data.length == 0) {
                $('#businessList').append(`
                    <tr id="no_company">
                      <td colspan="4" class="text-center text-muted">Không có công ty nào</td>
                    </tr>
                  `);
            } else {
                showCompanyList(data);
            }
    }) 
    $("#add_bttn").click(function(){
        $("#addBusinessModalLabel").html("Thêm Doanh Nghiệp Mới");
        $("#addCompany_bttn").html("Thêm");
        $("#addBusinessName").val("");
        $("#addTaxCode").val("");
        $("#addPassword").val("");
        $("#nameErr").html("");
        $("#MSTErr").html("");
        $("#passErr").html("");
        old_mst_input = "";
    })

    $("#addCompany_bttn").click(function() {
        if ($("#addBusinessName").val() == "" || $("#addTaxCode").val() == "" || $("#addPassword").val() == "") {
            alert("Nhập đầy đủ thông tin.");
        } else {
            if (validateName($("#addBusinessName").val()).valid && validateMST($("#addTaxCode").val()).valid && validatePass($("#addPassword").val()).valid) {
                if (old_mst_input == "") { //chức năng thêm doanh nghiệp
                    $.post("./Settings/addCompany", //AJAX không tải lại
                        {username: "tuan",
                        token: "12345678",
                        company_name:$("#addBusinessName").val(),
                        MST: $("#addTaxCode").val(),
                        password:$("#addPassword").val()
                        },function(data){
                            data =  JSON.parse(data); //dữ liệu JSON
                            if (data == 1) {
                                alert("Thêm doanh nghiệp thành công.")
                                $('#addBusinessModal').modal('hide');
                                $('#businessList').find('tr#no_company').remove();
                                var new_company = [{     
                                    company_name: $("#addBusinessName").val(),
                                    MST:$("#addTaxCode").val(),
                                    pass_word:$("#addPassword").val()
                                }];
                                showCompanyList(new_company);
                            } else if (data == -1) {
                                alert("Có lỗi xảy ra, vui lòng thử lại.");
                            } else if (data == 0) {
                                alert("Doanh nghiệp này đã tồn tại.");
                            }
                    
                        }) 
                } else {//chức năng sửa doanh nghiệp
                    $.post("./Settings/changeCompanyInfo", //AJAX không tải lại
                        {username: "tuan",
                        token: "12345678",
                        old_MST: old_mst_input,
                        company_name:$("#addBusinessName").val(),
                        MST: $("#addTaxCode").val(),
                        password:$("#addPassword").val()
                        },function(data){
                            data =  JSON.parse(data); //dữ liệu JSON
                            if (data == 1) {
                                alert("Cập nhật doanh nghiệp thành công.")
                                $('#addBusinessModal').modal('hide');  
                                var new_company = [
                                    $("#addBusinessName").val(),
                                    $("#addTaxCode").val(),
                                    $("#addPassword").val()
                                ];
                                $('tr.modified').each(function () { 
                                    const tds = $(this).find('td');
                                    tds.each(function (index) {
                                      if (index === 2) {
                                        // Tìm thẻ input bên trong td thứ 3 và gán value
                                        $(this).find('input').val(new_company[index]);
                                      } else {
                                        // Gán text trực tiếp vào td
                                        $(this).text(new_company[index]);
                                      }
                                    });
                                  });
                                   
                            } else if (data == -1) {
                                alert("Có lỗi xảy ra, vui lòng thử lại.");
                            } else if (data == 0) {
                                alert("Doanh nghiệp này đã tồn tại.");
                            } else if(data == 2) {
                                alert("Không thay đổi");
                            }
                    
                        }) 
                }
                
            } else if (!validateName($("#addBusinessName").val()).valid || !validateMST($("#addTaxCode").val()).valid || !validatePass($("#addPassword").val()).valid) {
                $("#nameErr").html(validateName($("#addBusinessName").val()).error);
                $("#MSTErr").html(validateMST($("#addTaxCode").val()).error);
                $("#passErr").html(validatePass($("#addPassword").val()).error);
            }
        }

        
        
    })

    $("#save").click(function(){
        if (validateAccountInfo()) {
            $.post("./Settings/changeAccountInfo", //AJAX không tải lại
                {username: "tuan",
                token: "12345678",
                password: $('#newPassword').val(),
                email:$('#newEmail').val(),
                tel: $('#newPhone').val(),
                },function(data){
                    data =  JSON.parse(data); //dữ liệu JSON
                    if (data == 1) { //thành công
                        alert("Cập nhật thông tin tài khoản thành công.")
                    } else if (data == 0) {
                        alert("Cập nhật thông tin tài khoản thành công.")
                    } else if (data == -1) {
                        alert("Email hoặc số điện thoại đã được sử dụng bởi tài khoản khác.")
                    }
                }
            )
        }
    })
})

function validateName(name) {
    if (name.length > 50) {
      return { valid: false, error: "Tên doanh nghiệp không được vượt quá 50 ký tự." };
    }
    const regex = /^[\p{L}0-9 ]+$/u; // \p{L} cho phép chữ có dấu
    if (!regex.test(name)) {
      return { valid: false, error: "Tên doanh nghiệp không được chứa ký tự đặc biệt." };
    }
    return { valid: true, error: "" };
  }

  function validateMST(mst) {
    if (mst.length > 20) {
      return { valid: false, error: "Mã số thuế không được vượt quá 20 ký tự." };
    }
    const regex = /^\d+$/;
    if (!regex.test(mst)) {
      return { valid: false, error: "Mã số thuế chỉ được chứa chữ số." };
    }
    return { valid: true, error: "" };
  }

  function   validatePass(pass) {
    if (pass.length < 8) {
        return { valid: false, error: "Mật khẩu phải có ít nhất 8 ký tự." };
    }
    if (pass.length > 20) {
      return { valid: false, error: "Mật khẩu không được vượt quá 20 ký tự." };
    }
    if (/\s/.test(pass)) {
      return { valid: false, error: "Mật khẩu không được chứa khoảng trắng." };
    }
    return { valid: true, error: "" };
  }
function validateEmail(mail) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!mail) {
        return { valid: false, error: "Vui lòng nhập email." };
    }

    if (!emailRegex.test(mail)) {
        return { valid: false, error: "Email không đúng định dạng." };
    }

    return { valid: true, error: "" };
}

    //Xử lý sdt

    function validatePhoneNumber(mobile) {
        // Regex: đầu 03, 05, 07, 08, 09 + 8 số
        var vnf_regex = /^(0[3|5|7|8|9])[0-9]{8}$/;
        if (!mobile) {
            return {valid: false, error: "Vui lòng nhập số điện thoại." };;
        }
        if (!vnf_regex.test(mobile)) {
            return {valid: false, error: "Số điện thoại không hợp lệ." };;
        }
        return {valid: true, error: "" };;
    }

  function showCompanyList(data) {
    let mstToDelete = null;
    let trToDelete = null;
  
    for (let i = 0; i < data.length; i++) {
      const tr = document.createElement('tr');
      const td1 = document.createElement('td');
      const td2 = document.createElement('td');
      const td3 = document.createElement('td');
      const input3 = document.createElement('input');
      const td4 = document.createElement('td');
      td1.innerHTML = data[i].company_name;
      td2.innerHTML = data[i].MST;
      input3.type = 'password';
      input3.disabled = true;
      input3.value = data[i].pass_word;
      td3.append(input3);
      $(td4).addClass('text-center');
  
      // Tạo nút sửa
      const change_button = $('<button>', {
        class: 'btn btn-sm btn-info me-2 px-4',
        'data-bs-toggle': 'modal',
        'data-bs-target': '#addBusinessModal',
        text: 'Sửa'
      });
  
      // Tạo nút xoá
      const delete_button = $('<button>', {
        class: 'btn btn-sm btn-danger px-4',
        text: 'Xoá',
        'data-bs-toggle': 'modal',
        'data-bs-target': '#errorModal'
      });
      // Sự kiện Sửa: alert nội dung các cột
        change_button.on('click', function () {
            $("#addBusinessModalLabel").html("Sửa Doanh Nghiệp");
            $("#addCompany_bttn").html("Lưu");
            const currentRow = $(this).closest('tr');
            currentRow.addClass("modified");
            const companyName = currentRow.find('td:eq(0)').text();
            const mst = currentRow.find('td:eq(1)').text();
            const passwordInput = currentRow.find('input[type="password"]').val(); 
            $("#addBusinessName").val(companyName);
            $("#addTaxCode").val(mst) ;
            $("#addPassword").val(passwordInput);    
            old_mst_input = $("#addTaxCode").val();
        });
        
      // Sự kiện xoá: lưu MST & <tr> để dùng sau khi xác nhận
      delete_button.on('click', function () {
        mstToDelete = data[i].MST;
        trToDelete = $(this).closest('tr');
      });
  
      // Gắn nút vào hàng
      $(td4).append(change_button, delete_button);
      tr.append(td1, td2, td3, td4);
      $('#businessList').append(tr);
    }
  
    // Sự kiện xác nhận xoá từ modal
    $('#delete_confirm').off('click').on('click', function () {
      if (mstToDelete && trToDelete) {
        $.post('./Settings/deleteCompany', {
          MST: mstToDelete,
          token: '12345678'
        }, function (data) {
          data = JSON.parse(data);
          if (data == 1) {
            trToDelete.remove();
            $('#errorModal').modal('hide');
            if ($('#businessList').children('tr').length === 0) {
                $('#businessList').append(`
                  <tr id="no_company">
                    <td colspan="4" class="text-center text-muted">Không có công ty nào</td>
                  </tr>
                `);
              }
          } else {
            alert('Lỗi khi xoá.');
          }
        });
      }
    });
  }

  function validateAccountInfo() {
    const newPassword = $('#newPassword').val();
    const renewPassword = $('#renewPassword').val();
    const newEmail = $('#newEmail').val();
    const newTel = $('#newPhone').val();
    if (!newPassword && !renewPassword && newEmail === old_email && newTel === old_tel) {
        alert("Không có yêu cầu thay đổi.");
        return;
      } else if (newEmail == ""  && newTel == "") {
        alert("Vui lòng nhập đầy đủ thông tin.");
        return;
      }
    
      // Nếu nhập 1 trong 2 password thì bắt buộc phải nhập cả 2
      if (newPassword || renewPassword) {
        if (!newPassword || !renewPassword) {
          alert("Vui lòng nhập đầy đủ mật khẩu mới và xác nhận mật khẩu");
          return;
        }
    
        // Kiểm tra khoảng trắng và độ dài
        if(newPassword) {
            if(!validatePass(newPassword).valid) {
                alert(validatePass(newPassword).error);
                return;
            }    
        }
    
        // Kiểm tra trùng khớp
        if (newPassword !== renewPassword) {
          alert("Mật khẩu xác nhận không khớp");
          return;
        }
      }
    
      // Nếu email thay đổi thì validate định dạng email
      if (newEmail !== old_email) {
        if(!validateEmail(newEmail).valid) {
            alert(validateEmail(newEmail).error);
            return;
        }
      }
    
      // Nếu số điện thoại thay đổi thì validate
      if (newTel !== old_tel) {
        if(!validatePhoneNumber(newTel).valid) {
            alert(validatePhoneNumber(newTel).error);
            return;
        }   
      } 
      // Nếu qua được hết các bước, có thể gửi form hoặc gọi AJAX
      return true;
  }