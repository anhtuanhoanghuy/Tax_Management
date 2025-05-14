var thisPage = 1;
var limit = 10;
var maxPageButton = 7;
var listElement = document.getElementById("data-table-body");
var list = listElement.children;
const token = getCookie("accessToken");
console.log("JWT:", token);
$(document).ready(function(){
    // Sử dụng $.ajax để gửi yêu cầu với header Authorization
    $.ajax({
        url: "./Home/getCompanyInfo", // Địa chỉ API
        type: "POST",
        headers: {
            "Authorization": "Bearer " + token // Thêm token vào header
        },
        success: function(data) {
            data = JSON.parse(data); // Dữ liệu trả về là JSON
            if (data.length == 0) {
                $(".menu").append(`<li><span>Không có công ty</span></li>`);
            } else {
                for (var x = 0; x < data.length; x++) {
                    $(".menu").append(`<li class="Company" MST-value="${data[x].MST}" pass-value="${data[x].pass_word}">
                        ${data[x].company_name}
                    </li>`);
                }
            }
        },
        error: function(xhr, status, error) {
            console.log("Có lỗi xảy ra: " + error);
        }
    });

    // Các sự kiện khác cho phần menu và select
    $('.select').click(function(){
        $('.select').toggleClass('select-clicked');
        $('.caret').toggleClass('caret-rotate');
        $('.menu').toggleClass('menu-open');
    });

$('.menu').on("click", ".Company", function() {
    var selectedCompany = $(this);
    var mstValue = selectedCompany.attr("MST-value");
    var passValue = selectedCompany.attr("pass-value");

    $('.selected').text(selectedCompany.text());
    $('.selected').attr('MST-value', mstValue);
    $('.select').removeClass('select-clicked');
    $('.caret').removeClass('caret-rotate');
    $('.menu').removeClass('menu-open');

    $('.menu li').each(function() {
        selectedCompany.removeClass('active');
    });
    var MST_token = "token_" + mstValue;
    if (getCookie(MST_token)) {
        alert(`Đã có token ${mstValue}`);
    } else {
        OpenModal(mstValue, passValue); // Gọi mở modal trước
        $("#warning").html("");
        $("#captchaValue").val("");
        getCaptcha().then(function(captchaKey) {
            $("#loginCompany").data("captchaKey", captchaKey); // Lưu captchaKey tạm để dùng sau
        }).catch(function(error) {
            console.error("Lỗi khi lấy captcha:", error);
        });
    }
});

    // Khi click vào nút Search
    $("#sold_bttn").click(function(){
        $('#statusSelect').prop('disabled', true);
    });
    $("#purchase_bttn").click(function(){
        $('#statusSelect').prop('disabled', false);
    });

    $('#search_bttn').click(function() {
        if ($('#startDate').val() != "" && $('#endDate').val() != "" && $('#startDate').val() > $('#endDate').val()) {
            alert("Không được chọn ngày bắt đầu lớn hơn ngày kết thúc.");
        } else {
            console.time("queryTime");   // Bắt đầu đo thời gian với nhãn "label"
            // Gọi API lấy thông tin thuế
            $.ajax({
                url: "./Home/getTaxInfo", // Địa chỉ API
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + token // Thêm token vào header
                },
                data: {
                    MST: $('.selected').attr('MST-value'),
                    tax_type: $('#v-pills-tab .nav-link.active').val(),
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val(),
                    result: $("#statusSelect").val()
                },
                success: function(data) {
                    data = JSON.parse(data);
                    $("#result_count").html(`Có ${data.length} kết quả`);
                    loadData(data);
                    console.timeEnd("queryTime"); // Kết thúc và in thời gian thực thi với cùng nhãn
                },
                error: function(xhr, status, error) {
                    console.log("Có lỗi xảy ra: " + error);
                }
            });
        }
    });

    $("#itemSelect").on("change", function () {
        limit = $(this).val(); // Cập nhật số item/trang
        thisPage = 1;           // Quay về trang đầu tiên
        loadItems();            // Load lại dữ liệu
    });
});


function loadData(data) { //load dữ liệu lên giao diện
        for (var j = list.length-1; j >= 0; j--) {
        listElement.removeChild(list[j]);
        };
        for (var i = 0; i < data.length; i++) {
            var r = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var td5 = document.createElement('td');
            var td6 = document.createElement('td');
            var td7 = document.createElement('td');
            var td8 = document.createElement('td');
            var td9 = document.createElement('td');
            var td10 = document.createElement('td');
            var td11 = document.createElement('td');
            var td12 = document.createElement('td');
            var td13 = document.createElement('td');
            td1.innerHTML = i+1;
            td2.innerHTML = data[i].invoice_sign;
            td3.innerHTML = data[i].invoice_id;
            td4.innerHTML = data[i].invoice_number;
            td5.innerHTML = data[i].invoice_date;
            td6.innerHTML = data[i].property;
            td7.innerHTML = data[i].name;
            td8.innerHTML = data[i].unit;
            td9.innerHTML = data[i].quantity;
            td10.innerHTML = data[i].unit_price;
            td11.innerHTML = data[i].discount;
            td12.innerHTML = data[i].tax + "%";
            td13.innerHTML = data[i].total;
            r.appendChild(td1);
            r.appendChild(td2);
            r.appendChild(td3);
            r.appendChild(td4);
            r.appendChild(td5);
            r.appendChild(td6);
            r.appendChild(td7);
            r.appendChild(td8);
            r.appendChild(td9);
            r.appendChild(td10);
            r.appendChild(td11);
            r.appendChild(td12);
            r.appendChild(td13);
            document.querySelector('#data-table > tbody').appendChild(r);                              
        }
        thisPage = 1;   
        loadItems();
    
}

function loadItems() {//tải thông tin thành từng trang để hiển thị
    let beginGet = limit * (thisPage - 1);
    let endGet = limit * thisPage - 1;
    for(let i = 0; i < list.length; i++) {
        if(i >= beginGet && i <= endGet) {
            list[i].style.display = 'table-row';
        }
        else list[i].style.display = 'none';
    }
    listPage();
}   
function listPage() {//tạo phần nút bấm để chuyển trang
    let count = Math.ceil(list.length / limit);
    $('.pagination-list').empty(); 
    if(list.length != 0) {//nếu có data thì hiển thị
        $(".pagination-list").addClass("d-flex");
        let firstpage = document.createElement('li');
        firstpage.innerHTML = "<<";
        document.querySelector('.pagination-list').appendChild(firstpage);
        let pre = document.createElement('li');
        pre.innerHTML = "<";
        document.querySelector('.pagination-list').appendChild(pre);
        if (thisPage != 1) {
            firstpage.setAttribute('onclick', "changePage(" + 1 + ")");
            pre.setAttribute('onclick', "changePage(" + (thisPage-1) + ")");
        } 
        else {
            firstpage.classList.add('disable');
            pre.classList.add('disable');
        }
        if(count <= (maxPageButton-1)) { //số trang nhỏ hơn 7
            for(let i = 1; i <= count; i++) {
                let pageNum = document.createElement('li');
                pageNum.innerText = i;
                if(i == thisPage) {
                    pageNum.classList.add('active');
                }
                pageNum.setAttribute('onclick', "changePage(" + i + ")");
                document.querySelector('.pagination-list').appendChild(pageNum);
            }
        }
        else {//số trang lớn hơn hoặc bằng 7
            if (thisPage > 0 && thisPage <= (maxPageButton-4)) { // có dạng 1,2,3,...,count 
                if(thisPage == (maxPageButton-4)) {
                    for(let i = 1; i <= (maxPageButton-1); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if(i == (maxPageButton-2)) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if(i == maxPageButton-1) {
                            pageNum.innerText = count;
                            if(thisPage == count) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + count + ")");
                        }
                        else {
                            pageNum.innerText = i;
                            if(i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
                else {
                    for(let i = 1; i <= (maxPageButton-2); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if(i == (maxPageButton-3)) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if(i == maxPageButton-2) {
                            pageNum.innerText = count;
                            if(thisPage == count) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + count + ")");
                        }
                        else {
                            pageNum.innerText = i;
                            if(i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
            }
            else if (thisPage > (count-(maxPageButton-4)) && thisPage <= count) {//có dạng 1,...,count-2,count-1,count
                if(thisPage == (count-(maxPageButton-5))){
                    for(let i = 1; i <= (maxPageButton-1); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if(i == 2) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if(i == 1) {
                            pageNum.innerText = i;
                            if(i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        else {
                            pageNum.innerText = (count-((maxPageButton-1)-i));
                            if(thisPage == (count-((maxPageButton-1)-i)) ) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + (count-((maxPageButton-1)-i)) + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
                else {
                    for(let i = 1; i <= (maxPageButton-2); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if(i == 2) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if(i == 1) {
                            pageNum.innerText = i;
                            if(i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        else {
                            pageNum.innerText = (count-((maxPageButton-2)-i));
                            if(thisPage == (count-((maxPageButton-2)-i)) ) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + (count-((maxPageButton-2)-i)) + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
                
            }
            else {//có dạng 1,...,4,5,6,...,count
                for(let i = 1; i <= maxPageButton; i++) {//giới hạn số nút 
                    let pageNum = document.createElement('li');
                    if(i == 2 || i == (maxPageButton-1)) {
                        pageNum.innerText = "...";
                        pageNum.classList.add('disable');
                    }
                    else if(i == 1) {
                        pageNum.innerText = i;
                        if(i == thisPage) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + i + ")");
                    }
                    else if(i == maxPageButton) {
                        pageNum.innerText = count;
                        if(count == thisPage) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + count + ")");
                    }
                    else {
                        pageNum.innerText = ((i-(Math.ceil(maxPageButton/2)))+thisPage);
                        if(thisPage == ((i-(Math.ceil(maxPageButton/2)))+thisPage) ) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + ((i-(Math.ceil(maxPageButton/2)))+thisPage) + ")");
                    }
                    document.querySelector('.pagination-list').appendChild(pageNum);
                }
            }
        }
        let next = document.createElement('li');
        next.innerHTML = ">";
        document.querySelector('.pagination-list').appendChild(next);
        let lastpage = document.createElement('li');
        lastpage.innerHTML = ">>";
        document.querySelector('.pagination-list').appendChild(lastpage);
        if (thisPage != count) {
            next.setAttribute('onclick', "changePage(" + (thisPage+1) + ")");
            lastpage.setAttribute('onclick', "changePage(" + count + ")");
        } 
        else {
            next.classList.add('disable');
            lastpage.classList.add('disable');
        }
    } else $(".pagination-list").css("display","none");
    
}
function changePage(i) {//chuyển trang
    thisPage = i;
    loadItems();
}

function getCaptcha() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "./Home/getCaptcha",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function (data) {
                data = JSON.parse(data);
                $("#captcha").empty();
                $("#captcha").append(data.content); // Hiển thị ảnh captcha mới
                resolve(data.key); // Trả về captchaKey mới
            },
            error: function (xhr, status, error) {
                reject(error);
            }
        });
    });
}

function OpenModal(MST, passValue) {
    var myModal = document.getElementById("loginMSTModal");
    var modalInstance = new bootstrap.Modal(myModal);
    modalInstance.show();

    // Khi nhấn nút Đăng nhập
    $("#loginCompany").off("click").on("click", function () {
        const captchaKey = $("#loginCompany").data("captchaKey"); // Lấy captchaKey hiện tại
        $.ajax({
            url: "./Home/authenticateCaptcha",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + token
            },
            data: {
                ckey: captchaKey,
                cvalue: $("#captchaValue").val(),
                password: passValue,
                MST: MST
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.token) {
                    modalInstance.hide();
                    console.log("Token:", data.token); 
                    // Có thể đóng modal ở đây nếu muốn
                } else {
                    // Thông báo lỗi và tải captcha mới
                    $("#warning").html(data.message);

                    // Load captcha mới và cập nhật captchaKey
                    getCaptcha().then(function(newKey) {
                        $("#loginCompany").data("captchaKey", newKey); // Ghi đè captchaKey
                        $("#captchaValue").val("");
                    }).catch(function (error) {
                        console.error("Không thể load captcha mới:", error);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("Có lỗi xảy ra khi xác thực: " + error);
            }
        });
    });
}


function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}