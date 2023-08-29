<?php
require_once('apps/views/layouts/header.php');
?>

<!-- Content -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">QuẢN LÝ NGƯỜI DÙNG</h6>
            <a class="btn btn-sm btn-success" href="index.php?controller=users&action=toCreate">Thêm</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white text-center">
                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số Điện Thoại</th>
                        <th scope="col">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // for ($i=0 ; $i < count($data['users']) ; $i++) {
                    //     echo "<tr class='text-white text-center'>";
                    //         echo "
                    //         <td><input class='form-check-input' type='checkbox'></td>
                    //         <td>".$data['users'][$i]->username."</td>
                    //         <td>".$data['users'][$i]->email."</td>
                    //         <td>".$data['users'][$i]->address."</td>
                    //         <td>".$data['users'][$i]->phone."</td>
                    //         <td><a class='btn btn-sm btn-info m-3' href='index.php?controller=users&action=delete&id=".$data['users'][$i]->id."'>Sửa</a><a class='btn btn-sm btn-primary' href='index.php?controller=users&action=destroy&id=".$data['users'][$i]->id."'>Xóa</a></td>
                    //         ";
                        
                    //     echo"</tr>";
                    // }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Content End -->

<?php
require_once('apps/views/layouts/footer.php');
?>