
var thisPage = 1;
var limit = 10;
var maxPageButton = 7;
var listElement = document.getElementById("data-table-body");
var list = listElement.children;
var myModal = $('#loginMSTModal');

    function checkCookie(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim(); // Remove leading/trailing whitespace
            // Does this cookie string begin with the name we want?
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1, cookie.length); // Return the cookie value
            }
        }
        return null; // Cookie not found
    }

$(document).ready(function () {
    $.post("./Home/getCompanyInfo", //AJAX không tải lại
        {
            username: "tuan",
            token: "12345678"
        }, function (data) {
            data = JSON.parse(data); //dữ liệu JSON
            console.log(data);
            if (data.length == 0) {
                $(".menu").append(`<li>
                <span>Không có công ty</span>
            </li>`)

            } else {
                for (var x = 0; x < data.length; x++) {
                    $(".menu").append(`<li class="Company" data-mst="${data[x].MST}" data-company_name="${data[x].company_name}" data-pass_word="${data[x].pass_word}"  >
                        ${data[x].company_name}
                    </li>`)
                }

            }

        })


    $('.select').click(function () {
        $('.select').toggleClass('select-clicked');
        $('.caret').toggleClass('caret-rotate');
        $('.menu').toggleClass('menu-open');
    });

    $('.menu').on("click", ".Company", function () {
        $('.selected').text($(this).text());
        $('.select').removeClass('select-clicked');
        $('.caret').removeClass('caret-rotate');
        $('.menu').removeClass('menu-open');
        $('.menu li').each(function () {
            $(this).removeClass('active');
        });

        //login
        var mst = $(this).data('mst');
        var companyName = $(this).data('company_name');
        var password = $(this).data('pass_word');


        var cookie = checkCookie("Token_" + mst);
            console.log("ok");
        if (cookie) {
            console.log(cookie);
        } else {
            //open modal
            //enter capcha 
            //summit
            myModal.modal("show")
            // suw lis login

            var data={
                "mst":mst,
                "token":"45344tetre"
            }
            $.post('http://localhost/Tax_Management/LoginCompany/Login', data, function (response) {
                // This function is called when the POST request is successful
                console.log('Success:', response);
                
            }).fail(function (error) {
                // This function is called when the POST request fails
                console.error('Error:', error);
                
            });
            
        }



    });



    $("#sold_bttn").click(function () {
        $('#statusSelect').prop('disabled', true);
    })
    $("#purchase_bttn").click(function () {
        $('#statusSelect').prop('disabled', false);
    })
    // Khi click vào nút Search, kiểm tra lại
    $('#search_bttn').click(function () { //Lấy thông tin thuếthuế
        if ($('#startDate').val() != "" && $('#endDate').val() != "" && $('#startDate').val() > $('#endDate').val()) {
            alert("Không được chọn ngày bắt đầu lớn hơn ngày kết thúc.")
        } else {
            $.post("./Home/getTaxInfo", //AJAX không tải lại
                {
                    MST: "1122334455",
                    tax_type: $('#v-pills-tab .nav-link.active').val(),
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val(),
                    result: $("#statusSelect").val()
                }, function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#result_count").html(`Có ${data.length} kết quả`);
                    loadData(data);
                })
        }

    }
    );

    $("#itemSelect").on("change", function () {
        limit = $(this).val(); // cập nhật số item/trang
        thisPage = 1;           // quay về trang đầu tiên
        loadItems();            // load lại dữ liệu
    });

})

function loadData(data) { //load dữ liệu lên giao diện
    for (var j = list.length - 1; j >= 0; j--) {
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
        td1.innerHTML = i + 1;
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
    for (let i = 0; i < list.length; i++) {
        if (i >= beginGet && i <= endGet) {
            list[i].style.display = 'table-row';
        }
        else list[i].style.display = 'none';
    }
    listPage();
}
function listPage() {//tạo phần nút bấm để chuyển trang
    let count = Math.ceil(list.length / limit);
    $('.pagination-list').empty();
    if (list.length != 0) {//nếu có data thì hiển thị
        $(".pagination-list").addClass("d-flex");
        let firstpage = document.createElement('li');
        firstpage.innerHTML = "<<";
        document.querySelector('.pagination-list').appendChild(firstpage);
        let pre = document.createElement('li');
        pre.innerHTML = "<";
        document.querySelector('.pagination-list').appendChild(pre);
        if (thisPage != 1) {
            firstpage.setAttribute('onclick', "changePage(" + 1 + ")");
            pre.setAttribute('onclick', "changePage(" + (thisPage - 1) + ")");
        }
        else {
            firstpage.classList.add('disable');
            pre.classList.add('disable');
        }
        if (count <= (maxPageButton - 1)) { //số trang nhỏ hơn 7
            for (let i = 1; i <= count; i++) {
                let pageNum = document.createElement('li');
                pageNum.innerText = i;
                if (i == thisPage) {
                    pageNum.classList.add('active');
                }
                pageNum.setAttribute('onclick', "changePage(" + i + ")");
                document.querySelector('.pagination-list').appendChild(pageNum);
            }
        }
        else {//số trang lớn hơn hoặc bằng 7
            if (thisPage > 0 && thisPage <= (maxPageButton - 4)) { // có dạng 1,2,3,...,count 
                if (thisPage == (maxPageButton - 4)) {
                    for (let i = 1; i <= (maxPageButton - 1); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if (i == (maxPageButton - 2)) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if (i == maxPageButton - 1) {
                            pageNum.innerText = count;
                            if (thisPage == count) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + count + ")");
                        }
                        else {
                            pageNum.innerText = i;
                            if (i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
                else {
                    for (let i = 1; i <= (maxPageButton - 2); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if (i == (maxPageButton - 3)) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if (i == maxPageButton - 2) {
                            pageNum.innerText = count;
                            if (thisPage == count) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + count + ")");
                        }
                        else {
                            pageNum.innerText = i;
                            if (i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
            }
            else if (thisPage > (count - (maxPageButton - 4)) && thisPage <= count) {//có dạng 1,...,count-2,count-1,count
                if (thisPage == (count - (maxPageButton - 5))) {
                    for (let i = 1; i <= (maxPageButton - 1); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if (i == 2) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if (i == 1) {
                            pageNum.innerText = i;
                            if (i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        else {
                            pageNum.innerText = (count - ((maxPageButton - 1) - i));
                            if (thisPage == (count - ((maxPageButton - 1) - i))) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + (count - ((maxPageButton - 1) - i)) + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }
                else {
                    for (let i = 1; i <= (maxPageButton - 2); i++) {//giới hạn số nút 
                        let pageNum = document.createElement('li');
                        if (i == 2) {
                            pageNum.innerText = "...";
                            pageNum.classList.add('disable');
                        }
                        else if (i == 1) {
                            pageNum.innerText = i;
                            if (i == thisPage) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + i + ")");
                        }
                        else {
                            pageNum.innerText = (count - ((maxPageButton - 2) - i));
                            if (thisPage == (count - ((maxPageButton - 2) - i))) {
                                pageNum.classList.add('active');
                            }
                            pageNum.setAttribute('onclick', "changePage(" + (count - ((maxPageButton - 2) - i)) + ")");
                        }
                        document.querySelector('.pagination-list').appendChild(pageNum);
                    }
                }

            }
            else {//có dạng 1,...,4,5,6,...,count
                for (let i = 1; i <= maxPageButton; i++) {//giới hạn số nút 
                    let pageNum = document.createElement('li');
                    if (i == 2 || i == (maxPageButton - 1)) {
                        pageNum.innerText = "...";
                        pageNum.classList.add('disable');
                    }
                    else if (i == 1) {
                        pageNum.innerText = i;
                        if (i == thisPage) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + i + ")");
                    }
                    else if (i == maxPageButton) {
                        pageNum.innerText = count;
                        if (count == thisPage) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + count + ")");
                    }
                    else {
                        pageNum.innerText = ((i - (Math.ceil(maxPageButton / 2))) + thisPage);
                        if (thisPage == ((i - (Math.ceil(maxPageButton / 2))) + thisPage)) {
                            pageNum.classList.add('active');
                        }
                        pageNum.setAttribute('onclick', "changePage(" + ((i - (Math.ceil(maxPageButton / 2))) + thisPage) + ")");
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
            next.setAttribute('onclick', "changePage(" + (thisPage + 1) + ")");
            lastpage.setAttribute('onclick', "changePage(" + count + ")");
        }
        else {
            next.classList.add('disable');
            lastpage.classList.add('disable');
        }
    } else $(".pagination-list").css("display", "none");

}
function changePage(i) {//chuyển trang
    thisPage = i;
    loadItems();
}
