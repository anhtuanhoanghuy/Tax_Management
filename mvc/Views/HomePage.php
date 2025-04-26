  <div class="container-fluid h-75 row mt-4 ms-1">
    <aside class="col-2 d-flex flex-column">


      <div class="row  mb-5  border-bottom pt-5">

        <select class="form-select form-select-sm col" id="selectCompany" aria-label=".form-select-sm example">
          <li class="list-group-item">
            <option value="0">Chọn công ty</option>
          </li>
          <li class="list-group-item">
            <option value="1">
              <a class="nav-link fs-5 " data-bs-toggle="modal" data-bs-target="#loginModal">Công ty A</a>
            </option>
          </li>
          <li class="list-group-item">
            <option value="2">Công ty B</option>
          </li>
        </select>
        <button type="button" class="btn btn-warning w-100 ms-3 col" data-bs-toggle="modal"
          data-bs-target="#errorModal">Đồng bộ</button>
      </div>

      <div class="row h-25">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active border-bottom" data-bs-toggle="pill" role="tab">Tra cứu hóa đơn điện tử bán ra</a>
          <a class="nav-link border-bottom" data-bs-toggle="pill" role="tab" aria-selected="false">Tra cứu hóa đơn điện
            tử mua vào</a>
          <a class="nav-link border-bottom" data-bs-toggle="pill" role="tab" aria-selected="false">Thống kê</a>

        </div>
      </div>

    </aside>

    <main class="col-10">
      <div class="row">
        <div class=" d-flex col-2 mb-3">
          <span class="align-item-end pt-2 mb-0" style=" vertical-align: text-bottom;">Từ:</span>

          <input type="date" class="form-control ms-3" id="startDate" name="startDate" placeholder="Ngày bắt đầu"
            aria-label="Starttime" aria-describedby="basic-addon1">
        </div>

        <div class=" col-2 mb-3 d-flex">
          <span class="align-item-end pt-2 mb-0" style=" vertical-align: text-bottom;">Đến:</span>
          <input type="date" class="form-control ms-3" id="endDate" name="endDate" placeholder="Ngày kết thúc"
            aria-label="Starttime" aria-describedby="basic-addon1">
        </div>
        <div class=" d-flex col-6 mb-3 dropdown">
          <span class="align-item-end pt-2 mb-0 col-2" style=" vertical-align: text-bottom;">Kết quả kiểm tra:</span>
          <select title="select" class="form-select" id="statusSelect" name="status">
            <option value="">Tất cả</option>
            <option value="expired">Cục thuế đã nhận</option>
            <option value="expired">Đang tiến hành kiểm tra cấp mã</option>
            <option value="expired">CQT từ chối hóa đơn theo từng lần phát sinh</option>
            <option value="expired">Hóa đơn đủ điều kiện cấp mã</option>
            <option value="expired">Hóa đơn không đủ điều kiện cấp mã</option>
            <option value="expired">Đã cấp mã hóa đơn</option>
            <option value="expired">Cục thuế đã nhận không mã</option>
            <option value="expired">Đã kiểm tra định kì HDDT không có mã</option>
            <option value="expired">Cục thuế đã nhận hóa đơn khởi tạo từ máy tính tiền</option>

          </select>

        </div>

        <div class=" col-2 mb-3 d-flex">
          <button class=" btn btn-warning">Tìm kiếm</button>
        </div>
        <div class=" col-12 mb-3 mt-3 d-flex flex-row-reverse ">
          <nav class="mx-4" aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link text-dark" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link text-dark" href="#">1/15</a></li>

              <li class="page-item">
                <a class="page-link text-dark" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              <select title="select"  class="form-select ms-3 " id="statusSelect" name="status">

                <option value="active ">15</option>
                <option value="checked">30</option>
                <option value="expired">50</option>
              
    
              </select>

              <li class="page-item w-100">
                <div class="tooltip-container">
                  <button class="button border-secondary border-1 h-100 ms-3" id="export">
                    <span class="material-symbols-outlined"> file_export </span>
                  </button>
                  <div class="tooltip-text">Xuất hóa đơn</div>
                </div>
              </li>
            </ul>
          </nav>
        </div>

      </div>




      <div class="border border-1 border-black vh-100 table-wrapper">
        <table class=" table table-bordered table-responsive">
          <thead>
            <tr class="table-warning">
              <th scope="col" class="first-col">STT</th>
              <th scope="col">Kí hiệu hóa đơn</th>
              <th scope="col">Số hóa đơn</th>
              <th scope="col">Ngày lập</th>
              <th scope="col">Tính chất</th>
              <th scope="col">Tên hàng hóa, dịch vụ</th>
              <th scope="col">Đơn vị tính</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Đơn giá</th>
              <th scope="col">Chiết khấu</th>
              <th scope="col">Thuế suất</th>
              <th scope="col">Thành tiền chưa có thuế GTGT</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>

    </main>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom border-warning border-3">
          <img src="static/img/title_icon.png" alt="">
          <h5 class="modal-title ms-3" id="loginModalLabel">Đăng nhập</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <form class="grid gap-0 row-gap-3" id="loginForm">
            <div class="mb-3 p-2 g-col-6">
              <label for="username" class="form-label">Tên đăng nhập</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3 p-2 g-col-6">
              <label for="password" class="form-label">Mật khẩu</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="mb-3">
              <a href="#">Quên mật khẩu</a>
            </div>
            <button type="button" class="btn btn-warning  d-flex justify-content-center " onclick="login()">Đăng
              nhập</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="loginMSTModal" tabindex="-1" aria-labelledby="loginMSTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-bottom border-warning border-3">
          <img src="static/img/title_icon.png" alt="">
          <h5 class="modal-title ms-3" id="loginMSTModalLabel">Đăng nhập</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <form class="grid gap-0 row-gap-3" id="loginMSTForm">

            <div class="mb-1 p-2 g-col-6">
              <label for="password" class="form-label">CapCha</label>
              <div class="input-group mb-1">
                <input type="input" class="form-control" id="captchaValue" name="passwordMST">
                <div class="btn btn-outline-secondary" type="button" id="captcha"></div>
              </div>
              <div class="text-danger" id="warning">Mật khẩu Doanh nghiệp đã bị thay đổi, vui lòng cấu hình lại.</div>
            </div>
            <button type="button" class="btn btn-warning  d-flex justify-content-center " id="loginCompany">Đăng
              nhập</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- From Uiverse.io by 3bdel3ziz-T -->
  <!-- Modal Error -->

  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="loginMSTModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-bottom border-warning border-3">
          <img src="static/img/title_icon.png" alt="">
          <h5 class="modal-title ms-3">Cảnh báo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <form class="grid gap-0 row-gap-3">

            <div class="mb-1 p-2 g-col-6">

              <div class="text-danger" id="warning">Mật khẩu Doanh nghiệp đã bị thay đổi, vui lòng cấu hình lại.</div>
            </div>
            <button type="button" class="btn btn-warning  d-flex justify-content-center ">
              <a href="/Tax_Management/Settings">Đến trang cài đặt</a>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script src="./public/js/LoginCompany.js"></script>

