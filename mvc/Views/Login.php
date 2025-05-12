<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang Đăng Nhập</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./public/css/Login.css">
  <script type="text/javascript" src="./public/js/jquery-3.2.1.min.js"></script>
</head>

<body>
  <div class="login_container ">

    <div class="card-header">
      <h3 class="text-center">Đăng Nhập</h3>
    </div>
    <div class="card-body">
      <form id="login">
        <div class="mb-3">
          <label for="username" class="form-label">Tên người dùng</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
        </div>
        <div class="mb-3">
          <div class="logContainer__space text-danger"></div>
        </div>
        <div class="d-grid">
          <button type = "button" class="btn btn-warning" id="logBttn">Đăng Nhập</button>
        </div>
        <div class="mb-3 mt-3">
          <a href="#" id="btnForgotPass" data-bs-toggle="modal" data-bs-target="#confirmSendEmailModal">Quên mật khẩu</a>
        </div>
      </form>
    </div>

  </div>

  <!-- Modal Forgot Password -->
  <div class="modal fade" id="confirmSendEmailModal" tabindex="-1" aria-labelledby="confirmSendEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog  ">
      <div class="modal-content">
        <div class="modal-header bg-warning ">
          <h5 class="modal-title" id="confirmSendEmailModalLabel">Xác Nhận Cấp Lại Mật Khẩu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <p>Để cấp lại mật khẩu mới, vui lòng liên hệ vào Số điện thoại: <b>0963657345</b></p>
          </div>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./public/js/Login.js"></script>

</html>