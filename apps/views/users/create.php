<?php
require_once('apps/views/layouts/header.php');
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center align-items-center">
        <div class="col-sm-12 col-xl-6">
            <form action="index.php?controller=users&action=createUser" method="post">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4 text-center">Cập Nhật Thông Tin Người Dùng </h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="" name="username" id="floatingInput"
                        placeholder="name@example.com">
                        <label for="floatingInput">Tên người dùng</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" value="" name="email" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="" name="address" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Địa chỉ</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="" name="phone" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Số điện thoại</label>
                    </div>
                    <div class="col-sm-12 col-xl-12 form-floating">
                        <select class="form-select form-select-sm mb-3" name="role_id" aria-label=".form-select-sm example">
                            <?php 
                            foreach ($roles as $key => $value) {
                                echo '
                                <option value="'.$value->id.'">'.$value->role_name.'</option>
                                ';
                            }
                            ?>
                        </select>
                        <label for="floatingInput">Vai Trò</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" value="" name="password" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Mật Khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" value="" name="password_confirmation" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Xác Nhận Mật Khẩu</label>
                    </div>
                    <div class="col-sm-12 col-xl-12 form-floating text-center">
                        <button class='btn btn-sm btn-success m-3' type="submit">Lưu Thông Tin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once('apps/views/layouts/footer.php');
?>