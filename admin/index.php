<?php
include("../model/pdo.php");
include("../model/danhmuc.php");
include("../model/sanpham.php");
include("include/header.php");
$danhmuc = LoadAll_DM();
$isthongbao = '';
$thongbao = '';
if (isset($_GET['act']) && $_GET['act'] != "") {

  $act = $_GET['act'];
  switch ($act) {
      // bảng danh mục 
    case 'danhmuc':
      include("danhmuc/list.php");
      break;
    case 'sldanhmuc':
      $tong = thongke();
      include("danhmuc/count.php");
      break;
    case 'xoadm':
      xoadm($_GET['iddm']);
      echo "  <script>alert('Đã Xóa Thành Công') </script> ";
      echo "  <script>window.location.href ='index.php?act=danhmuc'</script> ";
      break;
    case 'add':
      if (isset($_POST['gui']) && $_POST['gui'] != "") {
        $name = $_POST['name'];
        if ($name == null) {
          $isthongbao = 0;
          $thongbao = 'Không thành công';
        } else {
          $isthongbao = 1;
          add_dm($name);
          $thongbao = ' Thêm thành công';
        }
      }
      include("danhmuc/add.php");
      break;

    case 'editdm':
      $danhmuc = load_one_dm($_GET['iddm']);
      include("danhmuc/edit.php");
      break;

    case 'updm':
      if (isset($_POST['gui']) && $_POST['gui'] != "") {
        $name = $_POST['name'];
        $id = $_POST['id'];
        upload_dm($id, $name);
        echo "  <script>alert('Đã Cập Nhật Thành Công') </script> ";
        echo "  <script>window.location.href ='index.php?act=danhmuc'</script> ";
      }
      break;
      // bảng sản phẩm 
    case 'listsp':

      include("sanpham/list.php");
      break;
    case 'addsp':
      if (isset($_POST['gui']) && $_POST['gui'] != "") {
        $name = $_POST['name'];
        $giam_gia = $_POST['giam_gia'];
        $mota = $_POST['mo_ta'];
        $date = $_POST['date'];
        $gioitinh = $_POST['gt'];
        $dm = $_POST['dm'];
        $gia = $_POST['gia'];
        $file = $_FILES['img_sp'];
        $img = $file['name'];

        // echo "<pre>" ; 
        // var_dump($img_mt) ; 
        // die ();
        move_uploaded_file($file['tmp_name'], "../public/uploads/" . $img);
        $idspnew =   add_sanpham($name, $giam_gia, $mota, $date, $gioitinh, $dm, $gia, $img);
        if (isset($_FILES['img_mota'])) {
          $file_mt = $_FILES['img_mota'];
          $img_mt = $file_mt['name'];
          foreach ($img_mt as $key => $value) {
            add_img($value, $idspnew);
            move_uploaded_file($file_mt['tmp_name'][$key], "../public/uploads/" . $value);
          }
        }
        echo $idspnew;
        $isthongbao = 1;

        $thongbao = ' Thêm thành công';
      }
      include("sanpham/add.php");
      break;
    default:
      echo "  <script>window.location.href ='index.php'</script> ";
      break;
  }
} else {
  include("dashboard.php");
}
include("include/footer.php");
