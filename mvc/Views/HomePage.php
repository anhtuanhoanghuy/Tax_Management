
    <div class="d-flex flex-wrap align-items-center gap-3 ms-3 pt-3 search-bar-wrapper">
  
        <div class="dropdown">
            <div class="select">
                <span class="selected">--- Hãy chọn công ty ---</span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
            </ul>
        </div>
  
      <button class="btn btn-warning">Đồng bộ</button>
  
      <div class="form-label-group">
        <label class="mb-0">Từ:</label>
        <input id ="startDate" type="date" class="form-control" style="width: 160px;">
      </div>
  
      <div class="form-label-group">
        <label class="mb-0">Đến:</label>
        <input id ="endDate" type="date" class="form-control" style="width: 160px;">
      </div>
  
      <!--Kết quả kiểm tra -->
      <div class="form-label-group">
        <label class="mb-0">Kết quả kiểm tra:</label>
        <select id = "statusSelect" class="form-select long-option-select" disabled>
          <option value = "ii">Đã cấp mã hóa đơn</option>
          <option value = "iwc">Cục Thuế đã nhận không mã</option>
          <option value = "ftcr">Cục Thuế đã nhận hóa đơn có mã khởi tạo từ máy tính tiền</option>
        </select>
      </div>
  
      <button id ="search_bttn" class="btn btn-warning">Tìm kiếm</button>
    </div>

  <div class="container-fluid h-75 row ms-1">
    <aside class="col-2 d-flex flex-column">
      <div class="row pt-5 h-25">

        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button id="sold_bttn" class="nav-link active border-bottom" data-bs-toggle="pill" role="tab" value="sold">Tra cứu hóa đơn điện tử bán ra</button>
          <button id="purchase_bttn" class="nav-link border-bottom" data-bs-toggle="pill" role="tab" aria-selected="false" value="purchase">Tra cứu hóa đơn điện
            tử mua vào</button>
          <button class="nav-link border-bottom" data-bs-toggle="pill" role="tab" aria-selected="false" value="Statistics">Thống kê</button>

        </div>
      </div>

    </aside>

    <main class="col-10">
      <div class="row pt-1">
        <div class=" col-12 mb-3 mt-3 d-flex  ">
          <p id = "result_count" class="me-auto mb-0"></p>
          <nav class="pagination mx-4 d-flex align-items-center" aria-label="Page navigation example">
            <ul class="pagination-list mb-0"></ul>
              <select title="select" class="form-select ms-3" id="itemSelect" name="status">
                  <option value="10">10</option>
                  <option value="30">30</option>
                  <option value="50">50</option>
              </select>
              <div class="tooltip-container">
                  <button class="button border-secondary border-1 h-100 ms-3" id="export">
                    <span class="material-symbols-outlined"> file_export </span>
                  </button>
                  <div class="tooltip-text">Xuất hóa đơn</div>
              </div>

          </nav>
        </div>
      </div>




      <div id="table-container" class=" table-container border border-1 border-black vh-100 overflow-auto table-wrapper">
        <table id="data-table" class="table table-bordered table-responsive">
          <thead class="table-warning">
            <tr>
              <th scope="col" class="text-center">STT</th>
              <th scope="col" class="text-center">Kí hiệu mẫu số</th>
              <th scope="col" class="text-center">Kí hiệu hóa đơn</th>
              <th scope="col" class="text-center">Số hóa đơn</th>
              <th scope="col" class="text-center">Ngày lập</th>
              <th scope="col" class="text-center">Tính chất</th>
              <th scope="col" class="text-center">Tên hàng hóa, dịch vụ</th>
              <th scope="col" class="text-center">Đơn vị tính</th>
              <th scope="col" class="text-center">Số lượng</th>
              <th scope="col" class="text-center">Đơn giá</th>
              <th scope="col" class="text-center">Chiết khấu</th>
              <th scope="col" class="text-center">Thuế suất</th>
              <th scope="col" class="text-center">Thành tiền chưa có thuế GTGT</th>
            </tr>
          </thead>
          <tbody id="data-table-body">
            <!-- Dữ liệu sẽ được thêm vào đây bằng JS -->
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
  <div class="modal fade" id="loginMSTModal" tabindex="-1" aria-labelledby="loginMSTModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
              <div class="text-danger" id="warning"></div>
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
    <script src="./public/js/HomePage.js"></script>

