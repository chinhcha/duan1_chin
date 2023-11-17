<?php
function add_sanpham($name, $giam_gia, $mota, $date, $gioitinh, $dm, $gia, $img)
{
    $sql = " INSERT INTO `sanpham` (`id_sp`, `name_sp`, `image_sp`, `giam_gia`, `gia`, `mo_ta`, `ngay_nhap`, `view`, `gioi_tinh`, `id_dm`) 
    VALUES (NULL, '$name', '$img', '$giam_gia', '$gia', '$mota', '$date', '0', '$gioitinh', '$dm') ";
   $lastInsertedId = pdo_execute_return_lastInsertId($sql);

   return $lastInsertedId;
}
function add_img($name,$id)
{
    $sql = " INSERT INTO `img_sp`(`id_sp`, `img_url`) VALUES ('$id','$name') ";
   pdo_execute($sql);
}