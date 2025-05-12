    <div class="container-fluid vh-100 row align-items-start justify-content-center mt-4 ms-1">
        <div class="container mt-3 p-4 bg-white shadow rounded ">
            <div class="mb-4">
                <h3 class="mb-3 row">Cài Đặt Tài Khoản</h3>
                <form class="border-bottom border-dark">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Đổi Mật Khẩu</label>
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nhập Lại Mật Khẩu</label>
                            <input type="password" class="form-control" id="renewPassword"
                                placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <button id = "save" type="button" class="btn btn-primary mb-4">Lưu Thay Đổi</button>
                    </div>
                    <div class="col-8"></div>

                </form>
            </div>

            <div class="mt-4">
                <h3 class="mb-3">Cài Đặt Doanh Nghiệp</h3>
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <button id="add_bttn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBusinessModal">Thêm Doanh
                        Nghiệp</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr> 
                                <th class="text-center">Tên Doanh Nghiệp</th>
                                <th class="text-center">Mã Số Thuế</th>
                                <th class="text-center">Mật khẩu</th>
                                <th class="text-center">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="businessList">
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="addBusinessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusinessModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="mb-3">
                            <label for="addBusinessName" class="form-label">Tên Doanh Nghiệp</label>
                            <input type="text" class="form-control" id="addBusinessName"
                                placeholder="Nhập tên doanh nghiệp">
                            <span id="nameErr" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addTaxCode" class="form-label">Mã Số Thuế</label>
                            <input type="text" class="form-control" id="addTaxCode" placeholder="Nhập mã số thuế">
                            <span id="MSTErr" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Mật Khẩu</label>
                            <input type="password" class="form-control" id="addPassword" placeholder="Nhập mật khẩu">
                            <span id="passErr" class="text-danger"></span>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button id="addCompany_bttn" type="button" class="btn btn-primary px-4"></button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="loginMSTModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom border-warning border-3">
                    <img src="static/img/title_icon.png" alt="">
                    <h5 class="modal-title ms-3">Cảnh báo</h5>
                </div>
                <div class="modal-body ">
                    <form class="grid gap-0 row-gap-3">

                        <div class="mb-1 p-2 g-col-6">

                            <div class="text-danger" id="warning">Bạn chắc chắn muốn xóa doanh nghiệp.</div>
                        </div>
                        <div class="d-flex flex-row-reverse ">
                            <button id="delete_confirm" type="button"
                                class="btn btn-danger  d-flex justify-content-center ms-0 px-4 ">Xóa</button>
                            <button id="cancel_confirm" type="button" class="btn btn-secondary  d-flex justify-content-center  me-2 px-4  "
                                data-bs-dismiss="modal">Hủy</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"
        integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+"
        crossorigin="anonymous"></script>
        <script src="./public/js/SettingsPage.js"></script>
