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
                            <input type="password" class="form-control" id="newPassword"
                                placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="newEmail" placeholder="Nhập email mới">
                        </div>
                        <div class="mb-3">
                            <label for="newPhone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="newPhone" placeholder="Nhập số điện thoại mới">
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Lưu Thay Đổi</button>
                    </div>
                    <div class="col-8"></div>

                </form>
            </div>

            <div class="mt-4">
                <h3 class="mb-3">Cài Đặt Doanh Nghiệp</h3>
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBusinessModal">Thêm Doanh
                        Nghiệp</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Mã Số Thuế</th>
                                <th>Tên Doanh Nghiệp</th>
                                <th class="text-center">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="businessList">
                            <tr>
                                <td>0123456789</td>
                                <td>Công Ty ABC</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info me-2 px-4" data-bs-toggle="modal"
                                        data-bs-target="#editBusinessModal-0123456789">Sửa</button>

                                    <button class="btn btn-sm btn-danger px-4" data-bs-toggle="modal"
                                        data-bs-target="#errorModal" onclick="deleteBusiness('0123456789')">Xóa</button>
                                </td>
                            </tr>

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
                    <h5 class="modal-title" id="addBusinessModalLabel">Thêm Doanh Nghiệp Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="mb-3">
                            <label for="addBusinessName" class="form-label">Tên Doanh Nghiệp</label>
                            <input type="text" class="form-control" id="addBusinessName"
                                placeholder="Nhập tên doanh nghiệp">
                        </div>
                        <div class="mb-3">
                            <label for="addTaxCode" class="form-label">Mã Số Thuế</label>
                            <input type="text" class="form-control" id="addTaxCode" placeholder="Nhập mã số thuế">
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Mật Khẩu</label>
                            <input type="password" class="form-control" id="addPassword" placeholder="Nhập mật khẩu">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBusinessModal-0123456789" tabindex="-1" role="dialog" data-bs-backdrop="static"
        aria-labelledby="editBusinessModalLabel-0123456789" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBusinessModalLabel-0123456789">Sửa Doanh Nghiệp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editTaxCode-0123456789" class="form-label">Mã Số Thuế</label>
                            <input type="text" class="form-control" id="editTaxCode-0123456789" value="0123456789"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editBusinessName-0123456789" class="form-label">Tên Doanh Nghiệp</label>
                            <input type="text" class="form-control" id="editBusinessName-0123456789"
                                value="Công Ty ABC">
                        </div>
                        <div class="mb-3">
                            <label for="editPassword-0123456789" class="form-label">Mật Khẩu</label>
                            <input type="password" class="form-control" id="editPassword-0123456789"
                                placeholder="Nhập mật khẩu mới">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary">Lưu Thay Đổi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBusinessModal-9876543210" aria-labelledby="editBusinessModalLabel-9876543210"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBusinessModalLabel-9876543210">Sửa Doanh Nghiệp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editTaxCode-9876543210" class="form-label">Mã Số Thuế</label>
                            <input type="text" class="form-control" id="editTaxCode-9876543210" value="9876543210"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editBusinessName-9876543210" class="form-label">Tên Doanh Nghiệp</label>
                            <input type="text" class="form-control" id="editBusinessName-9876543210"
                                value="Doanh Nghiệp XYZ">
                        </div>
                        <div class="mb-3">
                            <label for="editPassword-9876543210" class="form-label">Mật Khẩu</label>
                            <input type="password" class="form-control" id="editPassword-9876543210"
                                placeholder="Nhập mật khẩu mới">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary">Lưu Thay Đổi</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Error -->

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
                            <button type=" button "
                                class="btn btn-danger  d-flex justify-content-center ms-0 px-4 ">Xóa</button>
                            <button type=" button" class="btn btn-secondary  d-flex justify-content-center  me-2 px-4  "
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
